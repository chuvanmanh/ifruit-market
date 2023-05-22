@extends('frontend.layouts.master')
@section('title','Wishlist')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Wishlist</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th></th>
								<th>Tên sản phẩm</th>
								<th class="text-center">Tổng cộng</th>
								<th class="text-center"></th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
							@if(count(Helper::getAllProductFromWishlist()) > 0)
								@foreach(Helper::getAllProductFromWishlist() as $key=>$wishlist)
									<tr>
										@php
											$photo=explode(',',$wishlist->product['photo']);
										@endphp
										<td class="image" data-title="No"><img src="{{asset(str_replace('http://localhost', '', $photo[0]))}}" alt="{{$photo[0]}}"></td>
										<td class="product-des" data-title="Description">
											<p class="product-name"><a href="{{route('product-detail',$wishlist->product['slug'])}}">{{$wishlist->product['title']}}</a></p>
											<p class="product-des">{!!($wishlist['summary']) !!}</p>
										</td>
										<td class="total-amount" data-title="Total"><span>{{$wishlist['amount']}}</span> <u>đ</u></td>
										<td><a href="{{route('add-to-cart',$wishlist->product['slug'])}}" class='btn text-white'>Thêm vào giỏ hàng</a></td>
										<td class="action" data-title="Remove"><a href="{{route('wishlist-delete',$wishlist->id)}}"><i class="ti-trash remove-icon"></i></a></td>
									</tr>
								@endforeach
							@else
								<tr>
									<td class="text-center" colspan="5">
										Không có sản phẩm nào trong wishlist. <a href="{{route('product-grids')}}" style="color:blue;">Tiếp tục mua hàng</a>
									</td>
								</tr>
							@endif
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush
