<footer class="footer">
    <div class="uk-container uk-container-center">
        <div class="ft-upper">
            <div class="uk-grid uk-grid-collapse">
                @if($menu['footer-menu'])
                    @foreach($menu['footer-menu'] as $key => $val)
                    @php
                        if($key > 0) break;
                        $name = $val['item']->languages->first()->pivot->name;
                        $canonical = write_url($val['item']->languages->first()->pivot->canonical);
                    @endphp
                    <div class="uk-width-large-1-3">
                        <div class="ft-menu">
                            <div class="ft-heading">{{ $name }}</div>
                            @if($val['children'])
                                <ul class="uk-list uk-clearfix">
                                    @foreach($val['children'] as $children)
                                    @php
                                        $nameC = $children['item']->languages->first()->pivot->name;
                                        $canonicalC = write_url($children['item']->languages->first()->pivot->canonical);
                                    @endphp
                                    <li>
                                        <a href="{{ $canonicalC }}" title="{{ $nameC }}" >- {{ $nameC }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
                <div class="uk-width-large-1-3">
                    <div class="footer-center">
                        <div class="footer-logo-wrapper">
                            <img src="{{ asset('frontend/resources/img/footer-icon.png') }}" alt="footer-logo">
                            <h3 class="title">SHOP BAN BUON</h3>
                            <div class="since">SINCE 2020</div>
                        </div>
                        <div class="footer-address">
                            <p>{{ $system['contact_address'] }}</p>
                            <p>Hotline: {{ $system['contact_hotline'] }}</p>
                        </div>
                        <div class="follow-us-footer">
                            <div class="social-heading">THEO DÕI CHÚNG TÔI</div>
                            <div class="footer-social uk-flex uk-flex-middle uk-flex-center">
                                <a href="{{ $system['social_facebook'] }}" class="footer-social-item"><i class="fa fa-facebook"></i></a>
                                <a href="{{ $system['social_twitter'] }}" class="footer-social-item"><i class="fa fa-twitter"></i></a>
                                <a href="{{ $system['social_google'] }}" class="footer-social-item"><i class="fa fa-google"></i></a>
                                <a href="{{ $system['social_youtube'] }}" class="footer-social-item"><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
                @if($menu['footer-menu'])
                    @foreach($menu['footer-menu'] as $key => $val)
                    @php
                        if($key !== 1) continue;
                        $name = $val['item']->languages->first()->pivot->name;
                        $canonical = write_url($val['item']->languages->first()->pivot->canonical);
                    @endphp
                    <div class="uk-width-large-1-3">
                        <div class="ft-menu second">
                            <div class="ft-heading">{{ $name }}</div>
                            @if($val['children'])
                                <ul class="uk-list uk-clearfix">
                                    @foreach($val['children'] as $children)
                                    @php
                                        $nameC = $children['item']->languages->first()->pivot->name;
                                        $canonicalC = write_url($children['item']->languages->first()->pivot->canonical);
                                    @endphp
                                    <li>
                                        <a href="{{ $canonicalC }}" title="{{ $nameC }}" >- {{ $nameC }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="uk-container uk-container-center">
        <div class="uk-text-center">
            {!! $system['homepage_copyright'] !!}
        </div>
    </div>
</div>

<div class="nav-social PC hide-for-medium">
  <ul>
    <li>
      <a href="#">
        <img src="{{ asset('frontend/resources/img/icon-home.png') }}" alt="Về trang chủ">
        <br>Trang chủ </a>
    </li>
    <li>
      <a href="tel:{{ $system['contact_hotline'] }}">
        <img src="{{ asset('frontend/resources/img/icon_call.png') }}" alt="Liên hệ Hotline">
        <br>Liên hệ Hotline </a>
    </li>
    <li>
      <a href="https://zalo.me/{{ $system['contact_hotline'] }}" target="_blank">
        <img src="{{ asset('frontend/resources/img/icon_zalo.png') }}" alt="Nhắn tin Zalo">
        <br>Nhắn tin Zalo </a>
    </li>
    <li>
      <a href="{{ $system['social_facebook'] }}" target="_blank">
        <img src="{{ asset('frontend/resources/img/icon_messenger.png') }}" alt="Nhắn tin Messenger">
        <br>Nhắn tin Messenger </a>
    </li>
  </ul>
</div>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=103609027035330&autoLogAppEvents=1">
</script>

