@extends('layouts.form')
@section('title', '')
@section('content')
    <div class="main-content p-0">
        <section class="section">
            @include('form.form')
        </section>
    </div>
@endsection
@push('style')
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
                    success: function(response) {
                        if (response.is_success) {

                            $('.card-body').html(
                                '<div class="text-center gallery" id="success_loader"><img src="{{ asset('assets/images/success.gif') }}" class="" /><br><br><h2 class="w-100 ">' +
                                response.message + '</h2></div>');
                        } else {
                            iziToast.error({
                                title: 'Error!',
                                message: response.message,
                                position: 'topRight'
                            });
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
                        calculate_total($('input[name="' + input + '"]').attr('data-group'));
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
@endpush
