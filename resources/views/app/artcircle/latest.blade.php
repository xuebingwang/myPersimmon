@extends('app.layouts.cateyeartv2')

@section('style')
    <link href="https://cdn.bootcss.com/jquery.swipebox/1.4.4/css/swipebox.min.css" rel="stylesheet">
@endsection

@section('title', '最新朋友圈')
@section('content')


    <!-- 圈子title -->
    <div class="circle-title">
        <a class="homep-a homep-return back" href="javascript:;"></a>
        <a href="{{route('add_art_circle')}}" class="circle-btn circle-add"></a>
        <div class="circle-link clearfix">
            <a href="{{route('art_circle_recommend')}}">推荐</a>
            <a class="on" href="javascript:">最新</a>
            <a href="{{route('art_circle')}}">朋友圈</a>
        </div>
    </div>

    {{--<div style="height:1.1rem"></div>--}}

    <!-- 朋友圈列表 -->
    <div class="friends-c" style="margin-top: .2rem">
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
@endsection
