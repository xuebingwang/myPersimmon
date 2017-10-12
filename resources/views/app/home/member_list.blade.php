@extends('app.layouts.cateyeartv2')

@section('style')
    <link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
    <style>
        .works-wrap{ text-align: center;}
        .works-wrap a{ width: 33%; margin-right: 0.5%; float: left;}
        .right{ float:right !important;}
        .margin0{ margin: 0!important;}
    </style>
@endsection

@section('title', '猫眼艺术')
@section('content')


    <div class="sy-header">
        <div class="sy-head-top clearfix">
            <a class="sysearchbtn back" href="javascript:">
                <span class="icon icon-back"></span>
            </a>
            <h1>{{$category->category_name}}</h1>
            <a class="syadd" href="javascript:">
                <span class="icon icon-add"></span>
            </a>
        </div>
    </div>
    <div style="height: 1.45rem"></div>
    <div class="hot-pro-lists">
        <ul id="hot-works">
        @foreach($list as $item)
            <li>
                <div class="hot-author clearfix">
                    <a href="{{empty($item->domain)? route('php',$item->id) : ('/'.$item->domain)}}">
                        <img class="hothead" src="{{image_view2($item->avatar,80,80)}}" alt="">
                    </a>

                    <div class="hot-author-txt">
                        <div class="clearfix hotnbox">
                            <div class="hot-author-name">{{$item->name}}</div>
                        </div>
                        <div class="hot-author-bot clearfix">
                            <span>{{time_tran($item->last_login)}}来过</span>
                            <span class="hot-place city" data-city_id="{{$item->city_id}}"></span>
                        </div>

                        <a class="hot-zan gzbtn @if(in_array($item->id,$gz_list)) follow_btn @endif ajax-get" href="{{route('api_member_star',$item->id)}}" title="" submit_success="do_star_success">关注</a>

                    </div>
                </div>

                <div class="works-wrap">
                    <?php $works = $item->getWorks(3,1);?>
                    @if($works->isEmpty())
                        该用户暂无作品展示
                    @else
                        @foreach($works as $key=>$work)
                            <a href="{{route('work_info',$work->id)}}" class="@if($key < 1) left @endif @if($key == 2) right margin0 @endif">
                                <img src="{{image_view2($work->pic,100,100)}}">
                            </a>
                        @endforeach
                        <div class="clear"></div>
                    @endif
                </div>
            </li>
        @endforeach
        </ul>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>
        function do_star_success(obj,resp) {
            obj.toggleClass('follow_btn');
        }
    </script>
@endsection
