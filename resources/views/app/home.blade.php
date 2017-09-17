@extends('app.layouts.cateyeartv2')

@section('style')
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
@endsection

@section('title', '猫眼艺术')
@section('content')


    <!-- header start -->
    <div class="sy-header">
        <div class="sy-head-top clearfix">
            <a class="sysearchbtn" href="{{route('search')}}"></a>
            <h1>Cateyeart</h1>
            <a class="syadd" href="javascript:"></a>
        </div>
        <div class="sy-menu clearfix">
            <a class="on" href="###">热门</a>
            <a href="###">关注</a>
            <a href="###">艺术</a>
            <a href="###">设计</a>
            <a href="###">创意</a>
            <a href="###">空间</a>
        </div>
    </div>
    <div style="height: 2.45rem"></div>


    <!-- banner -->
    <div class="sy-banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($front_covers as $item)
                <div class="swiper-slide">
                    <a href="{{route('work_info',$item->work_id)}}">
                        <img src="{{image_view2($item->work_pic,375,188)}}" alt="">
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

    <!-- 热门作品 -->
    <div class="hot-pro-lists">
        <div class="hot-pro-tit">热门作品</div>
        <ul id="hot-works">
            @foreach($works as $work)
            <li>
                <div class="hot-author clearfix">
                    <a href="{{empty($work->member_domain)? route('php',$work->mid) : ('/'.$work->member_domain)}}">
                        <img class="hothead" src="{{image_view2($work->member_avatar,80,80)}}" alt="">
                    </a>
                    <div class="hot-author-txt">
                        <div class="clearfix hotnbox">
                            <div class="hot-author-name">{{$work->author}}</div>
                        </div>
                        <div class="hot-author-bot clearfix">
                            <span>{{time_tran($work->member_last_login)}}</span>
                            <span class="hot-place city" data-city_id="{{$work->member_city_id}}"></span>
                        </div>

                        <?php $work->likes = $work->getLikes(3,1); ?>
                        <div class="hot-zan">{{$work->likes->total()}}</div>
                    </div>
                </div>
                <div class="hot-opus">
                    <a href="{{route('work_info',$work->id)}}">
                        <img src="{{$work->pic}}" alt="">
                    </a>
                    <div class="hot-opus-mask">
                        <h1>{{$work->name}}</h1>
                        <p>{{show_work_params($work)}}</p>
                        @if($work->is_sale == \App\CatEyeArt\Common::YES)
                            <div class="opus-prize">￥</div>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    @include('app.common.v2nav')

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
    </script>
@endsection
