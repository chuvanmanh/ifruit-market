@extends('frontend.layouts.master')

@section('title','Checkout')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
                <form class="form" method="POST" action="{{route('cart.order')}}">
                    @csrf
                    <div class="row">

                        <div class="col-lg-8 col-12">
                            <div class="checkout-form">
                                <h2>Nhập các thông tin thanh toán</h2>
                                <p></p>
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Họ<span>*</span></label>
                                            <input type="text" name="first_name" placeholder="" value="{{old('first_name')}}" value="{{old('first_name')}}">
                                            @error('first_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Tên<span>*</span></label>
                                            <input type="text" name="last_name" placeholder="" value="{{old('lat_name')}}">
                                            @error('last_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Email<span>*</span></label>
                                            <input type="email" name="email" placeholder="" value="{{old('email')}}">
                                            @error('email')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Số điện thoại<span>*</span></label>
                                            <input type="number" name="phone" placeholder="" required value="{{old('phone')}}">
                                            @error('phone')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12" style="display: none;">
                                        <div class="form-group">
                                            <label>Quốc gia<span>*</span></label>
                                            <select name="country" id="country">
                                                <option value="VN" selected>Vietnam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Thành phố<span>*</span></label>
                                            <select name="city" id="city">
                                                @foreach( $cities as $city)
                                                    @if($city['ProvinceID'] == 201)
                                                        <option value="{{$city['ProvinceID']}}" selected>{{$city['ProvinceName']}}</option>
                                                    @else
                                                        <option value="{{$city['ProvinceID']}}">{{$city['ProvinceName']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group district">
                                            <label>Quận/Huyện<span>*</span></label>
                                            <select name="district" id="district">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group ward">
                                            <label>Phường/Xã<span>*</span></label>
                                            <select name="ward" id="ward">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Địa chỉ<span>*</span></label>
                                            <input type="text" name="address1" placeholder="" value="{{old('address1')}}">
                                            @error('address1')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12" style="display:none;">
                                        <div class="form-group">
                                            <label>Quận</label>
                                            <input type="text" name="address2" placeholder="" value="{{old('address2')}}">
                                            @error('address2')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12" style="display: none">
                                        <div class="form-group">
                                            <label>Mã bưu chính</label>
                                            <input type="text" name="post_code" placeholder="" value="{{old('post_code')}}">
                                            @error('post_code')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="cart_id" value="{{Helper::getCartId()}}">
                                </div>
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Hoá đơn</h2>
                                    <div class="content">
                                        <ul>
										    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Tổng<span>{{number_format(Helper::totalCartPrice(),2)}}<u>đ</u></span></li>
                                            <li class="shipping">
                                                Phí vận chuyển
                                                <span class="shipping-default">0.00 đ</span>

                                                <div class="ghn-services">

                                                </div>
                                                <input type="hidden" name="shipping_fee" value="" />
{{--                                                @if(count(Helper::shipping()) > 0 && Helper::cartCount() > 0)--}}
{{--                                                    <select name="shipping" class="nice-select">--}}
{{--                                                        <option value="">Chọn địa chỉ</option>--}}
{{--                                                        @foreach(Helper::shipping() as $shipping)--}}
{{--                                                            <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: {{$shipping->price}} <u>đ</u></option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                @else--}}
{{--                                                    <span>Free</span>--}}
{{--                                                @endif--}}
                                            </li>

                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">Bạn đã tiết kiệm<span>{{number_format(session('coupon')['value'],2)}}<u>đ</u></span></li>
                                            @endif
                                            @php
                                                $total_amount = Helper::totalCartPrice();
                                                if(session('coupon')){
                                                    $total_amount=$total_amount-session('coupon')['value'];
                                                }
                                            @endphp
                                            @if(session('coupon'))
                                                <li class="last"  id="order_total_price">Tổng hoá đơn<span>{{number_format($total_amount,2)}}<u>đ</u></span></li>
                                            @else
                                                <li class="last"  id="order_total_price">Tổng hoá đơn<span>{{number_format($total_amount,2)}}<u>đ</u></span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Payments</h2>
                                    <div class="content">
                                        <div class="checkbox">
                                            <form-group>
                                                <input name="payment_method"  type="radio" value="cod"> <label> Thanh toán khi nhận hàng</label><br>
                                                <input name="payment_method"  type="radio" value="paypal"> <label> VNPAY</label>
                                            </form-group>

                                        </div>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <button type="submit" class="btn">Đặt hàng</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->
@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			// alert(checkbox);
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
                let total = (subtotal + cost - coupon).toFixed(2);
                total = total + ' đ';
				$('#order_total_price span').text(total);
			});
            var cityId = 201;
            $.ajax({
                type:'POST',
                dataType: 'JSON',
                url:'{{route('checkout.district')}}',
                data:{'province_id' : cityId, '_token' : '{{@csrf_token()}}'},
                success:function(response) {
                    $('#district').append(response.option);
                    $('.district').find('.list').append(response.li);
                    $('.district').find('.current').text($('.district').find('.list .selected').text());
                }
            });
            $('#city').change(function(){
                $('#district').find('option').remove();
                $('.district').find('.list li').remove();
                var cityId = $(this).find('option:selected').val();
                $.ajax({
                    type:'POST',
                    dataType: 'JSON',
                    url:'{{route('checkout.district')}}',
                    data:{'province_id' : cityId, '_token' : '{{@csrf_token()}}'},
                    success:function(response) {
                        $('#district').append(response.option);
                        $('.district').find('.list').append(response.li);
                        $('.district').find('.current').text($('.district').find('.list .selected').text());
                    }
                });
            });
            var districtId = 3440;
            $.ajax({
                type:'POST',
                dataType: 'JSON',
                url:'{{route('checkout.ward')}}',
                data:{'district_id' : districtId, '_token' : '{{@csrf_token()}}'},
                success:function(response) {
                    $('#ward').append(response.option);
                    $('.ward').find('.list').append(response.li);
                    $('.ward').find('.current').text($('.ward').find('.list .selected').text());
                }
            });
            $('#district').change(function(){
                $('#ward').find('option').remove();
                $('.ward').find('.list li').remove();
                var districtId = $(this).find('option:selected').val();
                $.ajax({
                    type:'POST',
                    dataType: 'JSON',
                    url:'{{route('checkout.ward')}}',
                    data:{'district_id' : districtId, '_token' : '{{@csrf_token()}}'},
                    success:function(response) {
                        $('#ward').append(response.option);
                        $('.ward').find('.list').append(response.li);
                        $('.ward').find('.current').text($('.ward').find('.list .selected').text());
                    }
                });
            });


            {{--var toDistrictId = $('#district').find('option:selected').val();--}}
            {{--var toWardCode = $('#ward').find('option:selected').val();--}}

            {{--$.ajax({--}}
            {{--    type:'POST',--}}
            {{--    dataType: 'JSON',--}}
            {{--    url:'{{route('checkout.rate')}}',--}}
            {{--    data:{'to_ward_code' : toWardCode,'to_district_id' : toDistrictId, '_token' : '{{@csrf_token()}}'},--}}
            {{--    success:function(response) {--}}
            {{--        $('.shipping_fee').html(response.rate + ' đ');--}}
            {{--        let cost = parseFloat(response.rate) || 0;--}}
            {{--        let subtotal = parseFloat( $('.order_subtotal').data('price') );--}}
            {{--        let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;--}}
            {{--        let total = (subtotal + cost - coupon).toFixed(2);--}}
            {{--        total = total + ' đ';--}}
            {{--        $('#order_total_price span').text(total);--}}
            {{--    }--}}
            {{--});--}}
            $('#ward').change(function(){
                var toDistrictId = $('#district').find('option:selected').val();
                var toWardCode = $('#ward').find('option:selected').val();                $.ajax({
                    type:'POST',
                    dataType: 'JSON',
                    url:'{{route('checkout.services')}}',
                    data:{'to_ward_code' : toWardCode,'to_district_id' : toDistrictId, '_token' : '{{@csrf_token()}}'},
                    success:function(response) {
                        console.log(response);
                        $('.ghn-services').append(response.ratios);
                        // $('.shipping_fee').html(response.rate + ' đ');
                        // let cost = parseFloat(response.rate) || 0;
                        // let subtotal = parseFloat( $('.order_subtotal').data('price') );
                        // let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
                        // let total = (subtotal + cost - coupon).toFixed(2);
                        // total = total + ' đ';
                        // $('#order_total_price span').text(total);
                    }
                });
            });

            $('.ghn-services').click(function () {
                var shippingFee = $('input[name="service"]:checked').val();
                $('input[name="shipping_fee"]').attr('value', shippingFee)
                $('.shipping-default').html(shippingFee + 'đ');
                let cost = parseFloat(shippingFee) || 0;
                let subtotal = parseFloat( $('.order_subtotal').data('price') );
                let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
                let total = (subtotal + cost - coupon).toFixed(2);
                total = total + ' đ';
                $('#order_total_price span').text(total);

            });

		});

	</script>

@endpush
