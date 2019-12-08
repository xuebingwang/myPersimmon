@extends('app.layouts.cateyeartv2')

@section('title', '猫眼艺术')
@section('content')

    @include('app.common.index_header')

    <!-- banner -->
    <div class="sy-banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                <div class="swiper-slide">
                    <a href="{{$banner->url}}">
                        <img src="http://mall.cateyeart.com/attachment/{{$banner->thumb}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="main-menu clearfix">
        <a href="javascript:;">
            <img src="/cateyeart/v2/images/dasai.png" alt="">
            艺展大赛
        </a>
        <a href="javascript:;">
            <img src="/cateyeart/v2/images/renzheng.png" alt="">
            认证会员
        </a>
        <a href="javascript:;">
            <img src="/cateyeart/v2/images/zhengshu.png" alt="">
            数字证书
        </a>
    </div>

    <!-- 推荐展览 -->
    <div class="hot-pro-lists">
        <div class="hot-pro-tit">推荐展览</div>
        <ul id="hot-works">
            @foreach($works as $item)
            <li>
                <div class="hot-opus">
                    <a href="{{$vr_url}}tour/{{$item['view_uuid']}}">
                        <img src="{{$item['thumb_path']}}" height="180" alt="">
                        <span class="gplay"></span>
                    </a>
                    <span class="nmb-txt">免费展览</span>
                </div>
                <div class="hot-author clearfix">
                    <div class="hot-author-txt">
                        <div class="clearfix hotnbox">
                            <div class="hot-author-name">{{$item['name']}}</div>
                        </div>
                        <a class="hot-zan" href="javascript:">
                            <span class="icon icon-like"></span>
                            {{$item['browsing_num']}}
                        </a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    @include('app.common.nav')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>
        // banner
        new Swiper ('.sy-banner .swiper-container', {
            loop: true,
            autoplay : 5000,
            speed:800,
            autoplayDisableOnInteraction : false,
            pagination: '.swiper-pagination'
        })
    </script>
@endsection
