@php
    $wishlistCount = $wishlistCount ?? \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count();
    $compareCount = $compareCount ?? \Gloudemans\Shoppingcart\Facades\Cart::instance('compare')->count();
    $cartCount = $cartCount ?? \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count();
@endphp
<header class="pc-header uk-visible-large"><!-- HEADER -->
    <x-top-search />
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-medium uk-flex uk-flex-middle">
            <div class="uk-width-large-1-10">
                <div class="logo">
                    <a href="/" title="logo"><img src="{{ $system['homepage_logo'] }}" alt="logo"></a>
                </div>
            </div>
            <div class="uk-width-large-9-10">
                <div class="header-top">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <div class="header-contact">
                            <div class="uk-flex uk-flex-middle">
                                <div class="box-item uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_st.png') }}"
                                        alt="">
                                    <div class="box-text">
                                        <div class="box-head">Chi Nhánh</div>
                                        <div class="box-value">1 chi nhánh</div>
                                    </div>
                                </div>
                                <div class="box-item uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_1.png') }}"
                                        alt="">
                                    <div class="box-text">
                                        <div class="box-head">HotLine</div>
                                        <div class="box-value">{{ $system['contact_hotline'] }}</div>
                                    </div>
                                </div>
                                <div class="box-item uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_1.png') }}"
                                        alt="">
                                    <div class="box-text">
                                        <div class="box-head">Số điện thoại</div>
                                        <div class="box-value">{{ $system['contact_phone'] }}</div>
                                    </div>
                                </div>
                                <div class="box-item uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_2.png') }}"
                                        alt="">
                                    <div class="box-text">
                                        <div class="box-head">Email</div>
                                        <div class="box-value">{{ $system['contact_email'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-search">
                            <form action="" class="uk-form form">
                                <input type="text" name="keyword" value=""
                                    placeholder="Nhập vào từ khóa muốn tìm kiếm...." class="input-text">
                                <button type="submit" value="" name="submit">
                                    <img src="{{ asset('frontend/resources/img/icon/search-interface-symbol.png') }}"
                                        alt="Search">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="header-bottom">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        @include('frontend.component.navigation')
                        <div class="header-button-group uk-flex uk-flex-middle">
                            {{-- Nếu chưa đăng nhập --}}
                            @guest('customer')
                                <a href="{{ route('customer.login') }}" class="btn btn-login">
                                    <i class="fa fa-user"></i> Đăng nhập
                                </a>
                            @endguest

                            {{-- Nếu đã đăng nhập --}}
                            @auth('customer')
                                <a href="{{ route('customer.account') }}" class="btn btn-account">
                                    <i class="fa fa-user-circle"></i> Thông tin tài khoản
                                </a>

                                <form action="{{ route('customer.logout') }}" method="POST" class="logout-form">
                                    @csrf
                                    <button type="submit" class="btn btn-logout">
                                        <i class="fa fa-sign-out"></i> Đăng xuất
                                    </button>
                                </form>
                            @endauth


                            {{-- Nút yêu thích --}}
                            <a href="{{ route('product.wishlist.index') }}" class="p0" style="background: none;">
                                <span class="uk-position-relative">
                                    <i class="fa fa-heart"></i>
                                    <span class="wishlist-count uk-text-small uk-position-absolute"
                                        style="top: -6px; right: -2px;">
                                        {{ $wishlistCount }}
                                    </span>
                                </span>
                            </a>
                            {{-- Nút giỏ hàng --}}
                            <a href="{{ route('cart.checkout') }}" class="btn btn-cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="cart-count">{{ $cartCount }}</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><!-- .header -->
<header class="mobile-header uk-hidden-large">
    <section class="upper">
        <a class="moblie-menu-btn skin-1 offcanvas" href="#offcanvas" data-uk-offcanvas="{target:'#offcanvas'}">
            <span>Menu</span>
        </a>
        <div class="logo"><a href="" title="Logo"><img src="<?php echo $system['homepage_logo']; ?>" alt="Logo" /></a></div>
        <div class="mobile-hotline">
            <a class="value" href="tel:<?php echo $system['contact_hotline']; ?>" title="Tư vấn bán hàng"><?php echo $system['contact_hotline']; ?></a>
        </div>
    </section><!-- .upper -->
    <section class="lower">
        <div class="mobile-search">
            <form action="<?php echo write_url('tim-kiem'); ?>" method="" class="uk-form form">
                <input type="text" name="keyword" class="uk-width-1-1 input-text"
                    placeholder="Bạn muốn tìm gì hôm nay?" />
                <button type="submit" name="" value="" class="btn-submit">
                    <img src="{{ asset('frontend/resources/img/icon/search-interface-symbol.png') }}" alt="Search">
                </button>
            </form>
        </div>
    </section>
</header><!-- .mobile-header -->

<!-- Mobile Menu Offcanvas -->
<div id="offcanvas" class="uk-offcanvas">
    <div class="uk-offcanvas-bar uk-offcanvas-bar-flip mobile-menu-offcanvas">
        <button class="uk-offcanvas-close mobile-menu-close" type="button">
            <i class="fa fa-times"></i>
        </button>
        
        <div class="mobile-menu-header">
            <div class="mobile-menu-logo">
                <a href="/" title="Logo">
                    <img src="{{ $system['homepage_logo'] }}" alt="Logo" />
                </a>
            </div>
        </div>

        <nav class="mobile-menu-nav">
            <ul class="uk-nav uk-nav-offcanvas mobile-menu-list">
                {!! $menu['main-menu'] ?? '' !!}
            </ul>
        </nav>

        <div class="mobile-menu-footer">
            <div class="mobile-menu-actions">
                @guest('customer')
                    <a href="{{ route('customer.login') }}" class="mobile-menu-btn mobile-btn-login">
                        <i class="fa fa-user"></i> Đăng nhập
                    </a>
                @endguest

                @auth('customer')
                    <a href="{{ route('customer.account') }}" class="mobile-menu-btn mobile-btn-account">
                        <i class="fa fa-user-circle"></i> Tài khoản
                    </a>
                    <form action="{{ route('customer.logout') }}" method="POST" class="mobile-logout-form">
                        @csrf
                        <button type="submit" class="mobile-menu-btn mobile-btn-logout">
                            <i class="fa fa-sign-out"></i> Đăng xuất
                        </button>
                    </form>
                @endauth

                <a href="{{ route('product.wishlist.index') }}" class="mobile-menu-btn mobile-btn-wishlist">
                    <i class="fa fa-heart"></i> Yêu thích
                    @if($wishlistCount > 0)
                        <span class="mobile-badge">{{ $wishlistCount }}</span>
                    @endif
                </a>

                <a href="{{ route('cart.checkout') }}" class="mobile-menu-btn mobile-btn-cart">
                    <i class="fa fa-shopping-cart"></i> Giỏ hàng
                    @if($cartCount > 0)
                        <span class="mobile-badge">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>

            <div class="mobile-menu-contact">
                <div class="mobile-contact-item">
                    <i class="fa fa-phone"></i>
                    <a href="tel:{{ $system['contact_hotline'] }}">{{ $system['contact_hotline'] }}</a>
                </div>
                <div class="mobile-contact-item">
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:{{ $system['contact_email'] }}">{{ $system['contact_email'] }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Menu -->