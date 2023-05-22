<!-- Start Footer Area -->
<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top section">
        <div class="container">
            <div class="row">
                @php
                    $settings = DB::table('settings')->get();
                @endphp
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>LIÊN HỆ</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li><i class="ti-hand-point-right"></i>@foreach($settings as $data) {{$data->address}} @endforeach</li>
                                <li><i class="ti-email"></i>@foreach($settings as $data) {{$data->email}} @endforeach</li>
                                <li><i class="ti-comment-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <!-- End Single Widget -->
                </div>

                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>SẢN PHẨM</h4>
                        <ul>
                            <li><a href="#">Trái Cây Tươi</a></li>
                            <li><a href="#">Rau Sạch</a></li>
                            <li><a href="#">Organic</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>HỖ TRỢ</h4>
                        <ul>
                            <li><a href="#">Hướng dẫn mua hàng</a></li>
                            <li><a href="#">Chính sách đổi trả và hoàn tiền</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Chính sách giao hàng</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4>Tài khoản</h4>
                        <ul>
                            <li><a href="#">Đơn hàng</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Đăng nhập</a></li>
                            <li><a href="#">Đăng kí</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4>Đăng ký nhận email</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li><a href="#">Nhận điểm thành viên khi mua hàng sau khi đăng ký.</a></li>
                            </ul>

                            <section class="shop-newsletter sections">
                                <div class="container">
                                    <div class="row">
                                        <!-- Start Newsletter Inner -->
                                        <div class="inner">
                                            <form action="{{route('subscribe')}}" method="post" class="newsletter-inner">
                                                @csrf
                                                <input name="email" placeholder="Your email address" required="" type="email">
                                                <button class="btn" type="submit">Subscribe</button>
                                            </form>
                                        </div>
                                        <!-- End Newsletter Inner -->
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p>© iFruits Market 2023. All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="right">
                            <img src="{{asset('backend/img/vnp.png')}}" alt="#">
                        </div>
                        <div class="right">
                            <img src="{{asset('backend/img/momo.png')}}" alt="#">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /End Footer Area -->

<!-- Jquery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- Color JS -->
<script src="{{asset('frontend/js/colors.js')}}"></script>
<!-- Slicknav JS -->
<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
<!-- Magnific Popup JS -->
<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
<!-- Waypoints JS -->
<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
<!-- Countdown JS -->
<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
<!-- Nice Select JS -->
<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
<!-- Flex Slider JS -->
<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
<!-- ScrollUp JS -->
<script src="{{asset('frontend/js/scrollup.js')}}"></script>
<!-- Onepage Nav JS -->
<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
{{-- Isotope --}}
<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
<!-- Easing JS -->
<script src="{{asset('frontend/js/easing.js')}}"></script>

<!-- Active JS -->
<script src="{{asset('frontend/js/active.js')}}"></script>


@stack('scripts')
<script>
    setTimeout(function(){
      $('.alert').slideUp();
    },5000);
    $(function() {
    // ------------------------------------------------------- //
    // Multi Level dropdowns
    // ------------------------------------------------------ //
        $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();

            $(this).siblings().toggleClass("show");


            if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
            });

        });
    });
  </script>
