@extends('frontend.homepage.layout')
@section('content')
    @include('frontend.component.slide')
    @if(!is_null($widgets['intro']))
        @foreach($widgets['intro']->object as $key => $val)
        @php
            $trans =  $val->languages;
            $name = $trans->name;
            $canonical = write_url($trans->canonical);
            $description = $trans->description;
            $image = $widgets['intro']->album[0];
        @endphp

        <div class="panel-intro wow animate__animated animate__fadeIn" 
             data-wow-delay="{{ 0.2 * ($key + 1) }}s"
             style="background-image:url({{ $image }}); background-size:cover; background-position:center;">
            <div class="uk-container uk-container-center">
                <div class="panel-body">
                    <h2 class="heading wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                        <span>{{ $name }}</span>
                    </h2>

                    <div class="description wow animate__animated animate__fadeInUp" data-wow-delay="0.5s">
                        {!! $description !!}
                    </div>

                    <div class="btn-readmore wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
                        <a href="{{ $canonical }}" class="readmore">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    @if(!is_null($widgets['bring']))
    @php
        $image = $widgets['bring']->album[0];
        $name = $widgets['bring']->name;
    @endphp
        <div class="panel-bring">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-large uk-flex uk-flex-middle">
                    <div class="uk-width-medium-1-2">
                        <span class="image img-cover img-zoomin"><img src="{{ $image }}" alt="image"></span>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="bring-list">
                            <h2 class="heading"><span>{{ $name }}</span></h2>
                            @foreach($widgets['bring']->object as $item)
                            @php
                                $trans = $item->languages;
                                $post_name = $trans->name;
                                $post_description = $trans->description;
                                $post_image = $item->image;
                                $post_canonical = write_url($trans->canonical);
                            @endphp
                            <div class="bring-item">
                                <span class="icon"><img src="{{ $post_image }}" alt="{{ $post_name }}"></span>
                                <div class="info">
                                    <h3 class="title"><a href="{{ $post_canonical }}" title="{{ $post_name }}">{{ $post_name }}</a></h3>
                                    <div class="description">
                                        {!! $post_description !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(isset($widgets['p-hl']))
    <div class="panel-product">
        <div class="uk-container uk-container-center">
            <div class="panel-head">
                <div class="small-heading">Nổi bật</div>
                <h2 class="heading-1 heading"><span>Sản phẩm nổi bật</span></h2>
                <div class="description">{!! $widgets['p-hl']->description[1] !!}</div>
            </div>
            <div class="panel-body">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($widgets['p-hl']->object as $key => $val)
                        @php
                            $trans = $val->languages;
                            $name = $trans->name;
                            $canonical = write_url($trans->canonical);
                            $description = $trans->description;
                            $price = getPrice($val);
                            $image = $val->image;
                        @endphp
                        <div class="swiper-slide">
                            <div class="p-item">
                                <a href="{{ $canonical }}" class="image img-scaledown"><img src="{{ $image }}" alt="{{ $name }}"></a>
                                <div class="info">
                                    <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                                    <div class="description">
                                        {!! $description !!}
                                    </div>
                                    <div class="price">
                                        {!! $price['html'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(isset($widgets['category']))
        @foreach($widgets['category']->object as $key => $cat)
        @php
            $name = $cat->languages->name;
            $canonical = write_url($cat->languages->canonical);
            $description = $cat->languages->description;
        @endphp
        <div class="panel-category {{ $key % 2 === 0 ? 'cat-bg' : '' }}">
            <div class="uk-container uk-container-center">
                <div class="panel-head">
                    <h2 class="heading-1"><span>{{ $name }}</span></h2>
                    <div class="description">{!! $description !!}</div>
                    @if(isset($cat->childrens))
                    <div class="children">
                        <ul class="uk-clearfix uk-flex uk-flex-center uk-flex-middle">
                            @foreach($cat->childrens as $child)
                            <li>
                                <a href="{{ write_url($child->languages->canonical) }}" title="{{ $child->languages->name }}">
                                    <span class="icon"><img src="{{ asset('frontend/resources/img/icon/child-icon.png') }}" alt="icon"></span>
                                    <span>{{ $child->languages->name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($cat->products) && count($cat->products))
                    <div class="uk-grid uk-grid-medium">
                        @foreach($cat->products as $key => $product)
                        @php
                            if($key > 7) break;
                            $t = $product->languages[0];
                            $name = $t->name;
                            $canonical = write_url($t->canonical);
                            $ml = $product->ml;
                            $percent = $product->percent;
                            $madeIn = $product->made_in;
                            $image = $product->image;
                            $price = getPrice($product);
                        @endphp
                        <div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4 mb25">
                            <div class="product-item">
                                <a href="{{ $canonical }}" class="image img-scaledown img-zoomin"><img src="{{ $image }}" alt="{{ $name }}"></a>
                                <div class="info">
                                    <div class="wine-info uk-flex uk-flex-center">
                                        <span class="ml">{{ $ml }}ml</span>
                                        <span>{{ $percent }}%</span>
                                    </div>
                                    <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                                    <div class="price">
                                        {!! $price['html'] !!}
                                    </div>
                                    {{-- <div class="btn-readmore">
                                        <a href="{{ $canonical }}" class="readmore">Xem chi tiết</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    @endif

    @if(isset($widgets['feedback']))
        @foreach($widgets['feedback']->object as $cat)
        @php
            $nameCat = $cat->languages->name;
            $descriptionCat = $cat->languages->description;
        @endphp
        <div class="panel-feedback">
            <div class="uk-container uk-container-center">
                <div class="panel-head">
                    <div class="small-heading">Đánh giá</div>
                    <h2 class="heading-1"><span>{{ $nameCat }}</span></h2>
                    <div class="description">
                        {!! $descriptionCat !!}
                    </div>
                </div>
                @if(isset($cat->posts) && count($cat->posts))
                <div class="panel-body">
                    <div class="slide-nav">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($cat->posts as $keyPost => $post)
                            @php
                                $trans = $post->languages[0];
                                $name = $trans->name;
                                $canonical = write_url($trans->canonical);
                                $description = $trans->description;
                                $content = $trans->content;
                                $image = $post->image;
                            @endphp
                            <div class="swiper-slide">
                                <div class="feedback-item">
                                    <div class="info">
                                        <div class="description">
                                            {!! $content !!}
                                        </div>
                                    </div>
                                    <div class="uk-flex ava">
                                        <a href="{{ $canonical }}" class="image img-scaledown"><img src="{{ $image }}" alt="{{ $name }}"></a>
                                        <div class="c-info">
                                            <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                                            <div class="descritpion">{!! $description !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                </div>
        </div>
        @endforeach
    @endif

    @php
        $slideKeyword = App\Enums\SlideEnum::PARTNER;
    @endphp
    @if(count($slides[$slideKeyword]['item']))
        <div class="panel-partner">
            <div class="uk-container uk-container-center">
                <div class="wrapper">
                    <div class="panel-head">
                        <h3 class="heading-1 wow fadeInDown" data-wow-delay="0.1s">Đối tác</span></h3>
                        <div class="description wow fadeInDown" data-wow-delay="0.15s">{{ $slides[$slideKeyword]['short_code'] }}</div>
                    </div>
                    <div class="panel-body">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($slides[$slideKeyword]['item'] as $key => $val)
                                    @if($key % 2 == 0)
                                        <div class="swiper-slide partner-item">
                                    @endif

                                    <div class="slide-item wow fadeInDown" data-wow-delay="{{ 0.2 * ($key + 1) }}s">
                                        <a href="{{ $val['canonical'] }}" class="image img-scaledown">
                                            <img src="{{ $val['image'] }}" alt="">
                                        </a>
                                    </div>
                                    @if($key % 2 == 1 || $key == count($slides[$slideKeyword]['item']) - 1)
                                        </div> 
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- @dd($widgets['news']); --}}
    @if(isset($widgets['news']->object))
        @foreach($widgets['news']->object as $key => $cat)
        @php
            $nameCat = $cat->languages->name;
        @endphp
        <div class="panel-news cat-bg">
            <div class="uk-container uk-container-center">
                <div class="panel-head">
                    <div class="small-heading">Blog</div>
                    <h2 class="heading-1"><span>{{ $nameCat }}</span></h2>
                </div>
                <div class="panel-body">
                    @if(isset($cat->posts) && count($cat->posts))
                    <div class="uk-grid uk-grid-medium">
                        @foreach($cat->posts as $keyPost=> $post)
                        @php
                            if($keyPost > 7) break;
                            $trans = $post->languages[0];
                            $name = $trans->name;
                            $description = $trans->description;
                            $image = $post->image;
                            $canonical = write_url($trans->canonical);
                        @endphp
                        <div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-1-4 mb20">
                            <div class="new-item">
                                <a href="{{ $canonical }}" class="image img-cover"><img src="{{ $image }}" alt="{{ $name }}"></a>
                                <div class="info">
                                    <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                                    <div class="description">
                                        {!! $description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    @endif

    @if(isset($widgets['value']->object))
        @foreach($widgets['value']->object as $key => $cat)
        @php
            $nameCat = $cat->languages->name;
        @endphp
        <div class="panel-value">
            <div class="uk-container uk-container-center">
                <div class="panel-head">
                    <h2 class="heading-1"><span>{{ $nameCat }}</span></h2>
                </div>
                @if(isset($cat->posts) && count($cat->posts))
                <div class="panel-body">
                    <div class="uk-grid uk-grid-medium">
                        @foreach($cat->posts as $keyPost=> $post)
                        @php
                            $trans = $post->languages[0];
                            $name = $trans->name;
                            $description = $trans->description;
                            $image = $post->image;
                            $canonical = write_url($trans->canonical);
                        @endphp
                        <div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-2 uk-width-large-1-4">
                            <div class="value-item">
                                <a href="{{ $canonical }}" class="image img-cover"><img src="{{ $image }}" alt="{{ $name }}"></a>
                                <div class="info">
                                    <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                                    <div class="description">
                                        {!! $description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    @endif

    @if(isset($widgets['ship']->object))
    @foreach($widgets['ship']->object as $key => $post)
    @php
        $trans = $post->languages;
        $name = $trans->name;
        $description = $trans->description;
        $image = $post->image;
        $canonical = write_url($trans->canonical);
    @endphp
    <div class="panel-shipping">
        <div class="panel-body">
            <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle">
                <div class="uk-width-large-1-2">
                    <div class="info">
                        <h3 class="title"><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></h3>
                        <div class="description">
                            {!! $description !!}
                        </div>
                        <div class="readmore">
                            <a href="{{ $canonical }}" class="btn-readmore">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="uk-width-large-1-2">
                    <span class="image img-cover img-zoom-in"><img src="{{ $image }}" alt="{{ $name }}"></span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif

@endsection
