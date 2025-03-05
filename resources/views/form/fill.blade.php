@extends('layouts.main')
@section('title', 'Form')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Fill Forms') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('forms.index') }}">{{ __('Form') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Fill') }}</div>
                </div>
            </div>

            @include('form.form')
        </section>
    </div>

    <!-- /.content-wrapper -->
@endsection
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/jqueryform/css/demo.css') }}">
    <link href="{{ asset('assets/jqueryform/css/jquery.rateyo.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
@endpush

@push('script')

    <script src="{{ asset('assets/jqueryform/js/jquery.rateyo.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#setData").trigger('click');
            }, 30);
        });

        $(function() {
            $(document).on("submit", "#fill-form", function(e) {

                var $this = $("#save-form");
                var loadingText = '<i class="fa fa-spinner fa-spin"></i> Submiting form';
                if ($("#save-form").html() !== loadingText) {
                    $this.data('original-text', $("#save-form").html());
                    $this.html(loadingText);
                }

                e.preventDefault();
                var formData = new FormData($('#fill-form')[0]);
                formData.append('ajax', true);
                $.ajax({
                    type: "POST",
                    url: '{{ route('forms.fill.store', $form->id) }}',
                    data: formData,
                    processData: false,
                    contentType: false,



                    beforeSend: function() {
                        // setting a timeout
                        $('#save-form').attr('disabled', true);
                        $('#save-form').val(' Submiting...')

                    },


                    success: function(response) {
                        if (response.is_success) {

                            $('.card-body').html(
                                '<div class="text-center gallery" id="success_loader"><img src="{{ asset('assets/images/success.gif') }}" class="" /><br><br><h2 class="w-100 ">' +
                                response.message + '</h2></div>');
                            $('#save-form').attr('disabled', false);
                            $('#save-form').val(' Submit')
                        } else {
                            iziToast.error({
                                title: 'Error!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#save-form').attr('disabled', false);
                            $('#save-form').val('Submit')
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".custom_select").select2();
        })
        var $starRating = $('.starRating');
        if ($starRating.length) {
            $starRating.each(function() {
                var val = $(this).attr('data-value');
                var num_of_star = $(this).attr('data-num_of_star');
                $(this).rateYo({
                    rating: val,
                    halfStar: true,
                    numStars: num_of_star,
                    precision: 2,
                    onSet: function(rating, rateYoInstance) {
                        num_of_star = $(rateYoInstance.node).attr('data-num_of_star');
                        var input = ($(rateYoInstance.node).attr('id'));
                        if (num_of_star == 10) {
                            rating = rating * 2;
                        }
                        $('input[name="' + input + '"]').val(rating);
                    }
                })
            });
        }

        if ((".ck_editor").length) {
            CKEDITOR.replace($('.ck_editor').attr('name'), {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form'
            });
        }
    </script>

    @if ($form->payment_status == 1)

        <script>
            $(document).ready(function() {
                var stripe = Stripe('{{ setting('stripe_key') }}');

                var elements = stripe.elements();
                // Custom Styling
                var style = {
                    base: {
                        color: '#32325d',
                        lineHeight: '24px',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '18px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                };
                // Create an instance of the card Element
                var card = elements.create('card', {
                    style: style
                });
                // Add an instance of the card Element into the `card-element` <div>
                card.mount('#card-element');
                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function(event) {
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
                // Handle form submission
                var form = document.getElementById('fill-form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    stripe.createToken(card).then(function(result) {
                        if (result.error) {
                            // Inform the user if there was an error
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            stripeTokenHandler(result.token);
                        }
                    });
                });

            })
        </script>
        <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
        <script>
            // Send Stripe Token to Server
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('fill-form');

                // Add Stripe Token to hidden input
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit form
                form.submit();
            }
        </script>
    @endif

@endpush
