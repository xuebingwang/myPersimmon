@extends('app.layouts.cateyeartv2')

@section('style')
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/jquery.swipebox/1.4.4/css/swipebox.min.css" rel="stylesheet">
@endsection

@section('title', '推荐朋友圈')
@section('content')



    <!-- 圈子title -->
    <div class="circle-title">
        <a class="homep-a homep-return back" href="javascript:;">
            <span class="icon icon-back"></span>
        </a>
        <a href="{{route('add_art_circle')}}" class="circle-btn circle-add">
            <span class="icon icon-add"></span>
        </a>
        <div class="circle-link clearfix">
            <a class="on" href="###">推荐</a>
            <a href="{{route('art_circle_latest')}}">最新</a>
            <a href="{{route('art_circle')}}">朋友圈</a>
        </div>
    </div>
    <div style="height:1.1rem"></div>

    <!-- 推荐 -->
    <div class="groom">
        <div class="groomshop-lists">
            <div class="swiper-container" id="swiper-container1">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <a href="{{$banner->url}}">
                            <div class="groompic">
                                <img src="http://mall.cateyeart.com/attachment/{{$banner->thumb}}" alt="">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- 猫眼通知书 -->
    <div class="tzs">
        <a href="{{route('member_msg_info',0)}}" class="tzs-box clearfix">
            <img src="/cateyeart/v2/images/t_14.jpg" alt="">
            <div class="tzs-txt">
                <span><i class="icon icon-remind2" style="color: #da1217"></i>{{date('m-d')}}</span>

                <h1>猫眼艺术通知</h1>
            </div>
        </a>
    </div>
    <div class="tzs">
        <a href="{{route('member_contacts_fans')}}" class="tzs-box clearfix">
            <img src="/cateyeart/v2/images/t_14.jpg" alt="">
            <div class="tzs-txt">
                添加朋友
            </div>
        </a>
    </div>

    <!-- 朋友圈列表 -->
    <div class="friends-c infinite-scroll" data-distance="200">
        <ul id="item-wrap">
            @include('app.artcircle.art_circle_ajax')
        </ul>
        <input type="hidden" id="next-url" value="{{$list->nextPageUrl()}}" />
        <input type="hidden" id="distance" value="200" />
    </div>

    @include('app.common.nav')

@endsection

@section('scripts')
    @include('app.artcircle.common_js')
    <script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.min.js"></script>
    <script>
        // banner
        $(function () {
            new Swiper('.groom .swiper-container',{
                slidesPerView : 2,
                pagination: '.swiper-pagination',
                slidesPerColumnFill : 'row',
                slidesPerColumn : 2,
            })
        })
    </script>
@endsection
