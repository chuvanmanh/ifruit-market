<header class="header shop" >
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{route('home')}}"><img src="{{asset(str_replace('http://localhost', '', Helper::getLogo()))}}" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12 padding-top-2px">
                    <div class="header-search-bar layout-01">
                        <form action="{{route('product.search')}}" class="form-search" name="desktop-search" method="POST">
                            @csrf
                            <input type="search" name="search" class="input-text" value="" placeholder="Tôi muốn mua...">
                            <select name="category">
                                <option selected>Tất cả</option>
                                @foreach(Helper::getAllCategory() as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-submit"><i class="ti-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <div class="single-bar user-menu">
                            <span class="single-icon"><i class="ti-user"></i></span>
                            <!-- User Menu Item -->
                            <div class="user-menu-item">
                                <ul class="list-main">
{{--                                            <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Track Order</a></li>--}}
                                    @auth
                                        @if(Auth::user()->role=='admin')
                                            <li><a href="{{route('admin')}}"  target="_blank">Tài khoản</a></li>
                                        @else
                                            <li><a href="{{route('user')}}"  target="_blank">Tài khoản</a></li>
                                        @endif
                                            <li><a href="{{route('wishlist')}}">Wishlist<span> {{Helper::wishlistCount()}}</span></a></li>
                                            <li><a href="{{route('user.logout')}}">Đăng xuất</a></li>
                                    @else
                                        <li><a href="{{route('login.form')}}">Đăng nhập</a></li>
                                        <li><a href="{{route('register.form')}}">Đăng kí</a></li>
                                    @endauth
                                </ul>
                            </div>
                            <!--/ End User Menu Item -->
                        </div>
                        <div class="single-bar shopping">
                            <a href="{{route('cart')}}" class="single-icon"><i class="ti-bag"></i> <span class="total-count">{{Helper::cartCount()}}</span></a>
                            <!-- Shopping Item -->
                            @auth
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{count(Helper::getAllProductFromCart())}} Sản Phẩm</span>
                                        <a href="{{route('cart')}}">Xem giỏ hàng</a>
                                    </div>
                                    <ul class="shopping-list">
                                        {{-- {{Helper::getAllProductFromCart()}} --}}
                                            @foreach(Helper::getAllProductFromCart() as $data)
                                                    @php
                                                        $photo=explode(',',$data->product['photo']);
                                                    @endphp
                                                    <li>
                                                        <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                        <a class="cart-img" href="#"><img src="{{asset(str_replace('http://localhost', '', $photo[0]))}}" alt="{{$photo[0]}}"></a>
                                                        <h4><a href="{{route('product-detail',$data->product['slug'])}}" target="_blank">{{$data->product['title']}}</a></h4>
                                                        <p class="quantity">{{$data->quantity}} x <span class="amount">{{number_format($data->price,2)}}<u>đ</u></span></p>
                                                    </li>
                                            @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Tổng</span>
                                            <span class="total-amount">{{number_format(Helper::totalCartPrice(),2)}}<u>đ</u></span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate">Thanh toán</a>
                                    </div>
                                </div>
                            @endauth
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('home')}}">Trang chủ</a></li>
{{--                                            <li class="@if(Request::path()=='product-grids'||Request::path()=='product-lists')  active  @endif"><a href="{{route('product-grids')}}">Sản phẩm</a></li>--}}
                                                {{Helper::getHeaderCategory()}}
                                            <li class="{{Request::path()=='blog' ? 'active' : ''}}"><a href="{{route('blog')}}">Blog</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">Giới thiệu</a></li>
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">Liên hệ</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
