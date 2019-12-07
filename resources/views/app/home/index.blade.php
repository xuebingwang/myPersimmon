@extends('app.layouts.cateyeartv2')

@section('style')
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
@endsection

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

    {{--<div class="main-menu clearfix">--}}
        {{--<a href="javascript:;"><img src="images/m_03.jpg" alt=""></a>--}}
        {{--<a href="javascript:;"><img src="images/m_05.jpg" alt=""></a>--}}
        {{--<a href="javascript:;"><img src="images/m_07.jpg" alt=""></a>--}}
        {{--<a href="javascript:;"><img src="images/m_09.jpg" alt=""></a>--}}
    {{--</div>--}}

    <!-- 推荐展览 -->
    <div class="hot-pro-lists">
        <div class="hot-pro-tit">推荐展览</div>
        <ul id="hot-works">
            @foreach($works as $item)
            <li>
                <div class="hot-opus">
                    <a href="{{$vr_url}}tour/{{$item['view_uuid']}}">
                        <img src="{{$item['thumb_path']}}?imageMogr2/gravity/Center/crop/400x160" alt="">
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
    <script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.min.js"></script>
    <script src="http://img1.huapinhua.com/xbw.js?20170804"></script>
    <script src="http://img1.huapinhua.com/city_all.js?20170623"></script>
    <script>
        // banner
        new Swiper ('.sy-banner .swiper-container', {
            loop: true,
            autoplay : 5000,
            speed:800,
            autoplayDisableOnInteraction : false,
            pagination: '.swiper-pagination'
        })
        XBW.linkage.cityId2String($('#hot-works'));

        function do_like_success(obj,resp) {
            var like_total = obj.find('.like-total');

            var num = parseInt($.trim(like_total.text()));
            if(resp.data.is_liked){

                obj.find('.icon').removeClass('icon-like').addClass('icon-likefill');
                like_total.text(++num);
            }else{
                obj.find('.icon').removeClass('icon-likefill').addClass('icon-like');
                like_total.text(--num);
            }
        }
    </script>
@endsection
