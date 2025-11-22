@extends('frontend.homepage.layout')

@section('content')
    <div id="wishlist-page" class="page-body wishlist-page">
        <div class="uk-container uk-container-center">
            <div class="wishlist-head uk-text-center uk-margin-large">
                <h1>Danh sách yêu thích</h1>
                <p>{{ $products->total() }} sản phẩm bạn đã lưu.</p>
            </div>

            @if ($products->count())
                <ul
                    class="wishlist-grid uk-list uk-clearfix
            uk-grid
            uk-grid-width-1-2
            uk-grid-width-small-1-2
            uk-grid-width-medium-1-2
            uk-grid-width-large-1-4">

                    @foreach ($products as $wishlistProduct)
                        @php
                            $title = $wishlistProduct->languages->first()->pivot->name;
                            $canonical = write_url($wishlistProduct->languages->first()->pivot->canonical);
                            $image = $wishlistProduct->image;
                            $price = getPrice($wishlistProduct);
                            $ml = $wishlistProduct->ml;
                            $percent = $wishlistProduct->percent;
                        @endphp

                        <li class="wishlist-item">
                            <div class="product-item">
                                <button type="button" class="wishlist-remove removeWishlist"
                                    data-id="{{ $wishlistProduct->id }}" aria-label="Bỏ yêu thích">
                                    <i class="fa fa-times"></i>
                                </button>
                                <a href="{{ $canonical }}" class="image img-scaledown img-zoomin">
                                    <img src="{{ $image }}" alt="{{ $title }}">
                                </a>
                                <div class="info">
                                    <div class="wine-info uk-flex uk-flex-center">
                                        <span class="ml">{{ $ml }}ml</span>
                                        <span>{{ $percent }}%</span>
                                    </div>
                                    <h3 class="title">
                                        <a href="{{ $canonical }}" title="{{ $title }}">{{ $title }}</a>
                                    </h3>
                                    <div class="price">
                                        {!! $price['html'] !!}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="uk-flex uk-flex-center">
                    @include('frontend.component.pagination', ['model' => $products])
                </div>
            @else
                <div class="wishlist-empty uk-text-center">
                    <h3>Chưa có sản phẩm nào trong danh sách yêu thích</h3>
                    <p>Tiếp tục khám phá để thêm những sản phẩm bạn thích.</p>
                    <a href="{{ route('home.index') }}" class="btn btn-primary">Quay lại mua sắm</a>
                </div>
            @endif
        </div>
    </div>
@endsection
