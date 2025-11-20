@php
    // Chuẩn bị dữ liệu
    $prd_title = $product->name;
    $prd_code = $product->code;
    $prd_model = $product->model ?? '';

    $list_image = [...json_decode($product->album) ?? []];
    $prd_href = write_url($product->canonical ?? '');
    $prd_description = $product->description ?? '';
    $prd_extend_des = $product->content ?? '';
    $price = getPrice($product);
    $stockQuantity = (int) ($product->stock ?? 0);

@endphp


@extends('frontend.homepage.layout')

@section('content')

    <div id="prddetail" class="page-body" style="background:#fff;">
        <x-breadcrumb :breadcrumb="$breadcrumb" />


        <section class="prddetail">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-medium uk-grid-width-large-1-2">


                    <div class="product-gallery">
                        @if (isset($list_image) && !empty($list_image) && !is_null($list_image))
                            <div class="product-list_image">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-container">
                                    <div class="swiper-wrapper big-pic">
                                        <?php foreach($list_image as $key => $val){  ?>
                                        <div class="swiper-slide" data-swiper-autoplay="2000">
                                            <a href="{{ $val }}" data-fancybox="my-group"
                                                class="image img-cover img-v">
                                                <img src="{{ image($val) }}" alt="<?php echo $val; ?>">
                                            </a>
                                        </div>
                                        <?php }  ?>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                                <div class="swiper-container-thumbs">
                                    <div class="swiper-wrapper pic-list">
                                        <?php foreach($list_image as $key => $val){  ?>
                                        <div class="swiper-slide">
                                            <span class="image img-cover"><img src="{{ image($val) }}"
                                                    alt="<?php echo $val; ?>"></span>
                                        </div>
                                        <?php }  ?>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Product info --}}
                    <div class="product-info">
                        <h1 class="prd-name">{{ $prd_title }}</h1>
                        <div class="rate-container">
                            <div class="uk-flex uk-flex-middle">
                                <div class="star-container uk-flex uk-flex-middle">
                                    <img src="{{ asset('frontend/resources/img/i.png') }}" alt="star">
                                    <img src="{{ asset('frontend/resources/img/i.png') }}" alt="star">
                                    <img src="{{ asset('frontend/resources/img/i.png') }}" alt="star">
                                    <img src="{{ asset('frontend/resources/img/i.png') }}" alt="star">
                                    <img src="{{ asset('frontend/resources/img/i.png') }}" alt="star">
                                </div>
                                <span class="star-count">4.8</span>
                                <span class="total-reviews">( {{ rand(200, 500) }} đánh giá)</span>
                                <span class="uk-flex uk-flex-middle point-breacker">
                                    <img src="{{ asset('frontend/resources/img/b.png') }}" alt="point">
                                    <span class="number">100% Điểm đánh giá</span>
                                </span>
                            </div>
                        </div>
                        <div class="description">
                            {!! $product->description !!}
                        </div>


                        <div class="product-price">
                            <div class="uk-flex uk-flex-middle">
                                <span>Giá: </span><span class="uk-text-danger">{!! $price['html'] !!}</span>
                            </div>
                        </div>


                        <div class="prd-option">
                            <div class="option-block">
                                <div class="product-stock">
                                    <div class="uk-grid uk-grid-medium uk-grid-width-large-1-2 uk-flex uk-flex-middle">
                                        <div class="prd-btn btn-addtocard">
                                            <a href="#order-buy" title="" id="btn-buy" data-uk-modal>
                                                <span class="title">Mua ngay</span>
                                                <span class="sub-title">Mua ngay để có giá tốt nhất</span>
                                            </a>
                                        </div>
                                        <div class="prd-btn btn-installment">
                                            <a href="tel:{{ $system['contact_hotline'] ?? '' }}"
                                                title="{{ $system['contact_hotline'] ?? '' }}">
                                                <span class="title">Liên hệ</span>
                                                <span class="sub-title">Liên hệ ngay để có giá tốt nhất</span>
                                            </a>
                                        </div>
                                    </div>
                                    @php
                                        $isOutOfStock = $stockQuantity <= 0;
                                    @endphp
                                    @if ($isOutOfStock)
                                        <div class="outstock-button mt20">
                                            <button type="button" class="btn-out-stock" disabled>
                                                <span class="icon">
                                                    <i class="fa fa-ban"></i>
                                                </span>
                                                <span class="title">Hết hàng</span>
                                            </button>
                                        </div>
                                    @else
                                        <div class="addcart-button mt20">
                                            <a href="" title="" class="addToCart"
                                                data-id="{{ $product->id }}">
                                                <span class="icon">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <circle cx="9" cy="21" r="1"></circle>
                                                        <circle cx="20" cy="21" r="1"></circle>
                                                        <path
                                                            d="M1 1h4l2.8 13.4c.2 1 1 1.6 2 1.6h9.6c1 0 1.8-.7 2-1.6L23 6H6">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span class="title">Thêm vào giỏ hàng</span>
                                            </a>
                                        </div>
                                    @endif
                                    <div class="product-stock-info mt15">
                                        <span>{{ __('messages.product.stock') }}:</span>
                                        <strong>{{ number_format($stockQuantity) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wine-detail-box">
                            <h3 class="title">Chi tiết loại rượu</h3>

                            <div class="wine-detail-grid">

                                <div class="item">
                                    <span class="label uk-flex uk-flex-middle">
                                        <img src="{{ asset('frontend/resources/img/pa_loai-vang.svg') }}" alt="icon">
                                        <span>Mã Sản Phẩm:</span>
                                    </span>
                                    <span class="value">{{ $product->code }}</span>
                                </div>

                                <div class="item">
                                    <span class="label uk-flex uk-flex-middle">
                                        <img src="{{ asset('frontend/resources/img/pa_nha-san-xuat.svg') }}"
                                            alt="icon">
                                        <span>Xuất Xứ:</span>
                                    </span>
                                    <span class="value">{{ $product->made_in }}</span>
                                </div>

                                <div class="item">
                                    <span class="label uk-flex uk-flex-middle">
                                        <img src="{{ asset('frontend/resources/img/pa_nong-do.svg') }}" alt="icon">
                                        <span>Xuất xứ:</span>
                                    </span>
                                    <span class="value">{{ $product->percent }}%</span>
                                </div>

                                <div class="item">
                                    <span class="label uk-flex uk-flex-middle">
                                        <img src="{{ asset('frontend/resources/img/pa_dung-tich.svg') }}" alt="icon">
                                        <span>Dung tích:</span>
                                    </span>
                                    <span class="value">{{ $product->ml }}ml</span>
                                </div>

                                <div class="item">
                                    <span class="label uk-flex uk-flex-middle">
                                        <svg class="mr10" width="25" height="25" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 7L12 3L21 7V17L12 21L3 17V7Z" stroke="#9B0D1F" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3 7L12 11L21 7" stroke="#9B0D1F" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 11V21" stroke="#9B0D1F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                        <span>Loại Sản Phẩm:</span>
                                    </span>
                                    <span class="value">{{ $productCatalogue->name }}</span>
                                </div>

                                <div class="item">
                                    <span class="label uk-flex uk-flex-middle">
                                        <img src="{{ asset('frontend/resources/img/pa_quoc-gia.svg') }}" alt="icon">
                                        <span>Bảo Quản:</span>
                                    </span>
                                    <span class="value">16–18°C</span>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <div class="block-extend">
            <div class="uk-container uk-container-center">

                {{-- Bản Desktop --}}
                <section class="prd-block uk-visible-large" id="prd-block">
                    <header class="panel-head">
                        <ul class="uk-list uk-clearfix nav-tabs"
                            data-uk-switcher="{connect:'#prd-nav-tabs', animation: 'uk-animation-fade'}">
                            <li>
                                <a>Thông tin sản phẩm</a>
                            </li>
                        </ul>
                    </header>

                    <section class="panel-body">
                        <ul id="prd-nav-tabs" class="uk-switcher">
                            <li>
                                <article class="prd-shipping-policy">
                                    {!! $product->content !!}
                                </article>
                            </li>
                        </ul>
                    </section>
                </section>

                {{-- Bản Mobile --}}
                <section class="prd-block uk-hidden-large mb20" id="prd-block-mobile">
                    <div class="uk-accordion" data-uk-accordion='{collapse: false}'>

                        <h2 class="uk-accordion-title" style="border: 0">
                            <span>Thông tin sản phẩm</span>
                        </h2>
                        <div class="uk-accordion-content">
                            <section class="dt-content">
                                {!! $product->content !!}
                            </section>
                        </div>
                    </div>
                </section>

                {{-- Sản phẩm liên quan --}}
                @if (!is_null($productCatalogue->products))
                    <section class="categories-panel">
                        <div class="uk-container uk-container-center">
                            <h2 class="heading-1">
                                <a href="#" onclick="return false;" title="Sản phẩm liên quan">Sản phẩm liên
                                    quan</a>
                            </h2>

                            <ul
                                class="uk-list uk-clearfix uk-grid uk-grid-small uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4">
                                @foreach ($productCatalogue->products as $key => $valPost)
                                    @php
                                        if ($key > 7) {
                                            break;
                                        }
                                        $name = $valPost->languages->first()->pivot->name;
                                        $image = $valPost->image;
                                        $canonical = write_url($valPost->languages->first()->pivot->canonical);
                                        $description = cutnchar(
                                            strip_tags($valPost->languages->first()->pivot->description),
                                            100,
                                        );
                                        $price = getPrice($valPost);
                                        $ml = $valPost->ml;
                                        $percent = $valPost->percent;
                                        $madeIn = $valPost->made_in;
                                    @endphp


                                    <li class="mb10">
                                        <div class="product-item">
                                            <a href="{{ $canonical }}" class="image img-scaledown img-zoomin"><img
                                                    src="{{ $image }}" alt="{{ $name }}"></a>
                                            <div class="info">
                                                <div class="wine-info uk-flex uk-flex-center">
                                                    <span class="ml">{{ $ml }}ml</span>
                                                    <span>{{ $percent }}%</span>
                                                </div>
                                                <h3 class="title"><a href="{{ $canonical }}"
                                                        title="{{ $name }}">{{ $name }}</a></h3>
                                                <div class="price">
                                                    {!! $price['html'] !!}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @endif
            </div>
        </div>



    </div> {{-- #prddetail --}}

    {{-- Modal --}}
    <div id="order-buy" class="uk-modal">
        <form action="" method="post" class="form uk-form" id="form-order-buy">
            <div class="uk-modal-dialog" style="padding: 0;">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-modal-header">
                    <h2 class="md-heading"><span>Đặt mua sản phẩm</span></h2>
                </div>

                <div class="modal-content loading">
                    <div class="bg-loader"></div>
                    <div class="error hidden">
                        <div class="alert alert-danger"></div>
                    </div>

                    <div class="uk-grid lib-grid-20">
                        <div class="uk-width-large-1-2">
                            <div class="form-control">
                                <label class="md-label">Họ tên</label>
                                <div class="form-row">
                                    <input required type="text" name="order_name" value="{{ old('order_name') }}"
                                        placeholder="Nhập họ tên" class="input-text order order-name" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-control">
                                <label class="md-label">Số điện thoại</label>
                                <div class="form-row">
                                    <input required type="tel" name="order_phone" value="{{ old('order_phone') }}"
                                        placeholder="Nhập số điện thoại" class="input-text order order-phone"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="form-control">
                                <label class="md-label">Email</label>
                                <div class="form-row">
                                    <input required type="email" name="order_email" value="{{ old('order_email') }}"
                                        placeholder="Nhập địa chỉ email" class="input-text order order-email"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="form-control">
                                <label class="md-label">Địa chỉ</label>
                                <div class="form-row">
                                    <input required type="text" name="order_address"
                                        value="{{ old('order_address') }}" placeholder="Số nhà, đường, ..."
                                        class="input-text order order-address" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="uk-width-large-1-2">
                            <div class="form-control">
                                <label class="md-label">Sản phẩm</label>
                                <div class="form-row">
                                    <input required type="text" name="order_title_prd"
                                        value="{{ old('order_title_prd', $product->name) }}" placeholder=""
                                        class="input-text order-title-prd" readonly autocomplete="off">
                                </div>
                            </div>

                            <div class="form-control">
                                <label class="md-label">Lời nhắn</label>
                                <div class="form-row">
                                    <textarea name="order_message" placeholder="Nhập lời nhắn" class="textarea order order-message" autocomplete="off"
                                        rows="4">{{ old('order_message') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-text-center">
                        <button type="submit" value="submit" class="btn order order-1">Gửi thông tin</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

@endsection

<style>
    .btn-out-stock {
        width: 100%;
        border: none;
        border-radius: 6px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: #d3d3d3;
        color: #4a4a4a;
        font-weight: 600;
        cursor: not-allowed;
    }

    .btn-out-stock .icon svg {
        stroke: #4a4a4a;
    }
</style>
