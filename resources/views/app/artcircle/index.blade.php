@extends('app.layouts.cateyeartv2')

@section('style')
    <link href="https://cdn.bootcss.com/jquery.swipebox/1.4.4/css/swipebox.min.css" rel="stylesheet">
@endsection

@section('title', '朋友圈')
@section('content')


    <!-- 圈子title -->
    <div class="circle-title">
        <a href="{{route('search')}}" class="circle-btn circle-search"></a>
        <a href="{{route('add_art_circle')}}" class="circle-btn circle-add"></a>
        <div class="circle-link clearfix">
            <a href="{{route('art_circle_recommend')}}">推荐</a>
            <a href="{{route('art_circle_latest')}}">最新</a>
            <a class="on" href="javascript:">朋友圈</a>
        </div>
    </div>
    <div style="height:1.1rem"></div>

    <div class="circle-user">
        <div class="circle-user-c clearfix">
            <img src="{{image_view2($member->avatar,100,100)}}" alt="">
            <h1>{{$member->name}}</h1>
        </div>
    </div>
    <div class="circle-hs"></div>

    <!-- 朋友圈列表 -->
    <div class="friends-c">
        <ul id="item-wrap">
            @if($list->isEmpty())
                <li class="font5 text-center">
                    Oh~ 暂时没有朋友圈内容,<br>多关注些朋友吧!
                </li>
            @endif
            @include('app.artcircle.art_circle_ajax')
        </ul>
        <input type="hidden" id="next-url" value="{{$list->nextPageUrl()}}" />
        <input type="hidden" id="distance" value="200" />
    </div>

    @include('app.common.nav')

@endsection

@section('scripts')
    @include('app.artcircle.common_js')
@endsection
