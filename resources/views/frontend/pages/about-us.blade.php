@extends('frontend.layouts.master')
@section('title','About Us')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Trang chủ<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="{{route('about-us')}}">Giới thiêụ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	<!-- About Us -->
	<section class="about-us section-body">
			<div class="container">
				<div class="row">
                    <div class="col-lg-12 col-12">
                        <img src="{{asset('/storage/photos/about-us.jpg')}}" alt="About Us">
                        <div class="about-content">
                            @php
                                $settings = DB::table('settings')->get();
                            @endphp
                            <h2>Về chúng tôi</h2>
                            <p><?php foreach ($settings as $data) echo $data->description ?></p>
                        </div>
                    </div>

				</div>
			</div>
	</section>
	<!-- End About Us -->
@endsection
