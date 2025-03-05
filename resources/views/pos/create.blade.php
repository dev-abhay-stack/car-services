@extends('layouts.admin')
@section('page-title')
    {{__('POs Create')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendors.index')}}">{{__('POs')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('POs Create')}}</li>
@endsection

@push('pre-purpose-script-page')
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.repeater.min.js')}}"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }

                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".amount");
                        var subTotal = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                        }
                        $('.subTotal').html(subTotal.toFixed(2));
                        $('.totalAmount').html(subTotal.toFixed(2));
                    }
                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

        }

        $(document).on('change', '#customer', function () {
            $('#customer_detail').removeClass('d-none');
            $('#customer_detail').addClass('d-block');
            $('#customer-box').removeClass('d-block');
            $('#customer-box').addClass('d-none');
            var id = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function (data) {
                    if (data != '') {
                        $('#customer_detail').html(data);
                    } else {
                        $('#customer-box').removeClass('d-none');
                        $('#customer-box').addClass('d-block');
                        $('#customer_detail').removeClass('d-block');
                        $('#customer_detail').addClass('d-none');
                    }

                },

            });
        });

        $(document).on('click', '#remove', function () {
            $('#customer-box').removeClass('d-none');
            $('#customer-box').addClass('d-block');
            $('#customer_detail').removeClass('d-block');
            $('#customer_detail').addClass('d-none');
        })

        $(document).on('change', '.item', function () {

            var iteams_id = $(this).val();
            var url = $(this).data('url');
            var el = $(this);
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'product_id': iteams_id
                },
                cache: false,
                success: function (data) {
                    var item = JSON.parse(data);
                    console.log(item)
                    $(el.parent().parent().find('.quantity')).val(1);
                    $(el.parent().parent().find('.price')).val(item.product.sale_price);
                    var taxes = '';
                    var tax = [];

                    var totalItemTaxRate = 0;

                    if (item.taxes == 0) {
                        taxes += '-';
                    } else {
                        for (var i = 0; i < item.taxes.length; i++) {
                            taxes += '<span class="badge badge-pill badge-primary mt-1 mr-1">' + item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' + '</span>';
                            tax.push(item.taxes[i].id);
                            totalItemTaxRate += parseFloat(item.taxes[i].rate);
                        }
                    }
                    var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item.product.sale_price * 1));
                    $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                    $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                    $(el.parent().parent().find('.taxes')).html(taxes);
                    $(el.parent().parent().find('.tax')).val(tax);
                    $(el.parent().parent().find('.unit')).html(item.unit);
                    $(el.parent().parent().find('.discount')).val(0);
                    $(el.parent().parent().find('.shipping')).val(0);

                    $(el.parent().parent().find('.amount')).html(item.totalAmount);


                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));


                    var totalItemPrice = 0;
                    var priceInput = $('.price');
                    for (var j = 0; j < priceInput.length; j++) {
                        totalItemPrice += parseFloat(priceInput[j].value);
                    }

                    var totalItemTaxPrice = 0;
                    var itemTaxPriceInput = $('.itemTaxPrice');
                    for (var j = 0; j < itemTaxPriceInput.length; j++) {
                        totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                    }

                    $('.totalTax').html(totalItemTaxPrice.toFixed(2));
                    $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));

                },
            });
        });

        $(document).on('keyup', '.quantity', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent().parent();
            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            var discount = $(el.find('.discount')).val();
            var shipping = $(el.find('.shipping')).val();
            var tax = $(el.find('.tax')).val();



            var totalItemPrice = (quantity * price);
            var amount = (totalItemPrice);

            $(el.find('.amount')).html(amount);

            var totalItemTaxRate = $(el.find('.tax')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }

            var totalItemShippingPrice = 0;
            var itemShippingPriceInput = $('.shipping');

            for (var k = 0; k < itemShippingPriceInput.length; k++) {
                totalItemShippingPrice += parseFloat(itemShippingPriceInput[k].value);
            }



            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }
            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));

        })

        $(document).on('keyup', '.price', function () {
            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.quantity')).val();
            var discount = $(el.find('.discount')).val();
            var shipping = $(el.find('.shipping')).val();
            var tax = $(el.find('.tax')).val();


            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);


            var totalItemTaxRate = $(el.find('.tax')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }

            var totalItemShippingPrice = 0;
            var itemShippingPriceInput = $('.shipping');

            for (var k = 0; k < itemShippingPriceInput.length; k++) {
                totalItemShippingPrice += parseFloat(itemShippingPriceInput[k].value);
            }


            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));

        })


        $(document).on('keyup', '.tax', function () {
            var el = $(this).parent().parent().parent().parent();
            var tax = $(this).val();
            var price = $(el.find('.price')).val();
            var quantity = $(el.find('.quantity')).val();
            var discount = $(el.find('.discount')).val();
            var shipping = $(el.find('.shipping')).val();


            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);


            var totalItemTaxRate = $(el.find('.tax')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemShippingPrice = 0;
            var itemShippingPriceInput = $('.shipping');

            for (var k = 0; k < itemShippingPriceInput.length; k++) {
                totalItemShippingPrice += parseFloat(itemShippingPriceInput[k].value);
            }

            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');

            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }

            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));

        })


        $(document).on('keyup', '.discount', function () {
            var el = $(this).parent().parent().parent().parent();
            var discount = $(this).val();
            var price = $(el.find('.price')).val();
            var quantity = $(el.find('.quantity')).val();
            var shipping = $(el.find('.shipping')).val();
            var tax = $(el.find('.tax')).val();



            var totalItemPrice = (quantity * price);

            var totalItemTaxRate = $(el.find('.tax')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');

            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }


            var totalItemShippingPrice = 0;
            var itemShippingPriceInput = $('.shipping');

            for (var k = 0; k < itemShippingPriceInput.length; k++) {
                totalItemShippingPrice += parseFloat(itemShippingPriceInput[k].value);
            }


            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);

            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }



            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));


            $('.totalAmount').html((parseFloat(subTotal) - parseFloat(totalItemDiscountPrice) + parseFloat(totalItemShippingPrice) + parseFloat(totalItemTaxPrice)).toFixed(2));
        })

        $(document).on('keyup', '.shipping', function () {
            var el = $(this).parent().parent().parent().parent();
            var shipping = $(this).val();
            var price = $(el.find('.price')).val();
            var quantity = $(el.find('.quantity')).val();
            var discount = $(el.find('.discount')).val();
            var tax = $(el.find('.tax')).val();


            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);


            var totalItemTaxRate = $(el.find('.tax')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemShippingPrice = 0;
            var itemShippingPriceInput = $('.shipping');

            for (var k = 0; k < itemShippingPriceInput.length; k++) {
                totalItemShippingPrice += parseFloat(itemShippingPriceInput[k].value);
            }

            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');

            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }

            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }

            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));
            $('.totalShipping').html(totalItemShippingPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));


            $('.subTotal').html(subTotal.toFixed(2));



            $('.totalAmount').html((parseFloat(subTotal) - parseFloat(totalItemDiscountPrice) + parseFloat(totalItemShippingPrice) + parseFloat(totalItemTaxPrice)).toFixed(2));



        })


        var customerId = '{{$customerId}}';
        if (customerId > 0) {
            $('#customer').val(customerId).change();
        }







        $('#vendorId').on('change', function (e) {
            var vendor_id = e.target.value;
            $.ajax({
                url: "{{ route('get_parts') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    vendor_id: vendor_id
                },
                success: function (data) {
                    $('#parts_id').empty();
                    $.each(data.parts, function (key,part) {
                        $('#parts_id').append(`<option value="${part.id}">${part.name}</option>`);
                    })
                }
            })
        });
    </script>



@endpush
@section('content')
    <div class="row">
        {{ Form::open(array('route' => ['pos.store'],'enctype' => 'multipart/form-data','class'=>'w-100')) }}

        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="partsid" value="{{ $partsid }}">
            <input type="hidden" name="wo_id" value="{{ $wo_id }}">
            <input type="hidden" name="vendorid" value="{{ $vendor_id }}">


            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class=" col-lg-3">
                            <div class="form-group" id="customer-box">

                                    {{ Form::label('vendor_id', __('Vendor'),['class'=>'form-label']) }}


                                    {{ Form::select('vendor_id', $Vendor,null, array('class' => 'form-control select2 ','data-url'=>route('pos.customer'),'required'=>'required', 'id'=>'vendorId')) }}

                            </div>
                            <div id="customer_detail" class="d-none">
                            </div>
                        </div>

                        <div class=" col-lg-3">
                            <div class="form-group">
                                    {{ Form::label('user_id', __('User'),['class'=>'form-label']) }}
                                    {{ Form::select('user_id', $User,null, array('class' => 'form-control select2 ','data-url'=>route('pos.customer'),'required'=>'required')) }}
                            </div>
                            <div id="customer_detail" class="d-none">
                            </div>
                        </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        {{ Form::label('po_date', __('Purchase Order Date'),['class'=>'form-label']) }}
                                            {{ Form::date('pos_date', '', array('class' => 'form-control datepicker','required'=>'required')) }}

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        {{ Form::label('delivery_date', __('Expected Delivery Date'),['class'=>'form-label']) }}
                                            {{ Form::date('delivery_date', '', array('class' => 'form-control datepicker','required'=>'required')) }}

                                    </div>
                                </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h5 class="h4 d-inline-block font-weight-400 mb-4">{{__('Parts & Services')}}</h5>
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box">
                                <a href="#" data-repeater-create="" class="btn btn-sm btn-primary btn-icon m-1"  data-bs-target="#add-bank">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table mb-0 table-custom-style" data-repeater-list="items" id="sortable-table">
                            <thead>
                            <tr>
                                <th>{{__('Items')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Price')}} </th>
                                <th>{{__('Tax')}} (%)</th>
                                <th>{{__('Discount')}}</th>
                                <th>{{__('Shipping')}}</th>

                                <th class="text-right">{{__('Amount')}} <br><small class="text-danger font-weight-bold">{{__('before tax & discount')}}</small></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <td >
                                    {{-- {{ Form::select('item', $Parts,null, array('class' => 'form-control select2 item','data-url'=>route('pos.product'),'required'=>'required')) }} --}}


                                    <select required class="form-control select2 item" name="item" id="parts_id" data-url = "{{ route('pos.product') }}" >
                                    </select>

                                </td>
                                <td >
                                    <div class="form-group">
                                        {{ Form::text('description', null, ['class'=>'form-control','rows'=>'2','placeholder'=>__('Description')]) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                        {{ Form::text('quantity','', array('class' => 'form-control quantity','required'=>'required','placeholder'=>__('Qty'),'required'=>'required')) }}

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                        {{ Form::text('price','', array('class' => 'form-control price','required'=>'required','placeholder'=>__('Price'),'required'=>'required')) }}

                                    </div>
                                </td>



                                <td>
                                    <div class="form-group">
                                        <div class="input-group colorpickerinput">
                                            <div class="taxes price-input">
                                                {{ Form::text('tax',0, array('class' => 'form-control tax','placeholder'=>__('Tax'),)) }}
                                                {{ Form::hidden('itemTaxPrice','', array('class' => 'form-control itemTaxPrice')) }}
                                                {{ Form::hidden('itemTaxRate','', array('class' => 'form-control itemTaxRate')) }}

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                        {{ Form::text('discount',0, array('class' => 'form-control discount','required'=>'required','placeholder'=>__('Discount'))) }}

                                    </div>
                                </td>

                                <td>
                                    <div class="form-group price-input">
                                        {{ Form::text('shipping',0, array('class' => 'form-control shipping','required'=>'required','placeholder'=>__('Shipping'))) }}

                                    </div>
                                </td>

                                <td class="text-right amount">{{ __("0.00") }}</td>
                                <td>
                                    <a href="#" class="fas fa-trash text-danger" data-repeater-delete></a>
                                </td>
                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong>{{__('Sub Total')}}
                                </strong></td>
                                <td class="text-right subTotal">{{ __("0.00") }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>

                                <td></td>
                                <td><strong>{{__('Discount')}}
                                </strong></td>
                                <td class="text-right totalDiscount">{{ __("0.00") }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong>{{__('Shipping')}}
                                </strong></td>
                                <td class="text-right totalShipping">{{ __("0.00") }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong>{{__('Tax')}}
                                </strong></td>
                                <td class="text-right totalTax">{{ __("0.00") }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="blue-text"><strong>{{__('Total Amount')}}
                                </strong></td>
                                <td class="text-right totalAmount blue-text"></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn  btn-light" onclick="location.href ='{{route('pos.index')}}'">{{ __('Close') }}</button>
            {{Form::submit(__('Create'),array('class'=>'btn btn-primary'))}}
        </div>
{{--
        <div class="col-12 text-right">
            <input type="submit" value="{{__('Create')}}" class="btn-create btn-xs badge-blue radius-10px">
            <input type="button" value="{{__('Cancel')}}" onclick="location.href ='{{route('pos.index')}}' class="btn-create btn-xs bg-gray radius-10px">
        </div> --}}
        {{ Form::close() }}
    </div>
@endsection


