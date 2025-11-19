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
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_st.png') }}" alt="">
                                    <div class="box-text">
                                        <div class="box-head">Chi Nhánh</div>
                                        <div class="box-value">1 chi nhánh</div>
                                    </div>
                                </div>
                                <div class="box-item uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_1.png') }}" alt="">
                                    <div class="box-text">
                                        <div class="box-head">HotLine</div>
                                        <div class="box-value">{{ $system['contact_hotline'] }}</div>
                                    </div>
                                </div>
                                <div class="box-item uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_1.png') }}" alt="">
                                    <div class="box-text">
                                        <div class="box-head">Số điện thoại</div>
                                        <div class="box-value">{{ $system['contact_phone'] }}</div>
                                    </div>
                                </div>
                                <div class="box-item uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/icon/icon_poly_hea_2.png') }}" alt="">
                                    <div class="box-text">
                                        <div class="box-head">Email</div>
                                        <div class="box-value">{{ $system['contact_email'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-search">
                            <form action="" class="uk-form form">
                                <input 
                                    type="text"
                                    name="keyword"
                                    value=""
                                    placeholder="Nhập vào từ khóa muốn tìm kiếm...."
                                    class="input-text"
                                >
                                <button type="submit" value="" name="submit">
                                   <img src="{{ asset('frontend/resources/img/icon/search-interface-symbol.png') }}" alt="Search">
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

                           

                            {{-- Nút giỏ hàng --}}
                            <a href="{{ route('cart.checkout') }}" class="btn btn-cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="cart-count">{{ Cart::count() ?? 0 }}</span>
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
		<a class="moblie-menu-btn skin-1" href="#offcanvas" class="offcanvas" data-uk-offcanvas="{target:'#offcanvas'}">
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
				<input type="text" name="keyword" class="uk-width-1-1 input-text" placeholder="Bạn muốn tìm gì hôm nay?" />
				<button type="submit" name="" value="" class="btn-submit">Tìm kiếm</button>
			</form>
		</div>
	</section>
</header><!-- .mobile-header -->
