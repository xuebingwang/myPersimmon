@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/work_list.css') }}">
@endsection
@section('title', '')
@section('body-style', 'homepage-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <header class="bar bar-nav">
                <a class="button button-link button-nav pull-left back"></a>
                <h1 class="title">2017</h1>
                {{--<a href="javascript:;" data-id="78578" data-type="4" class="btn-share button pull-right p-more-btn"></a>--}}
            </header>
            <div class="content native-scroll feed-content infinite-scroll">
                <div class="content-block">
                    <div class="list-block">
                        <div class="feed-list-container">
                            <ul class="list-container" id="list">
                                @foreach($works as  $work)
                                <li class="item-content">
                                    <div class="item-style-1 clearfix item-style-box">
                                        <div class="list-item-works clearfix">
                                            <a href="{{route('work_info',$work->id)}}">
                                                <div class="p-relative">
                                                    <div class="images-works" style="background-color: rgb({{mt_rand(0,255)}}, {{mt_rand(0,179)}}, {{mt_rand(0,179)}}); background-image: url({{$work->pic}});"></div>
                                                    <div class="d-price">
                                                        <div class="info-t">
                                                            <h4>{{$work->name}}</h4>
                                                            <h5>
                                                                {{$work->category_name}}<i>/</i>{{$work->size_w}}×{{$work->size_h}}cm<i>/</i>{{$work->times}}<i>/</i>@if($work->is_sale == \App\CatEyeArt\Common::NO)非卖品@endif
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="thumbs-box-warp">
                                            <div class="zan-heart-warp">
                                                <a href="javascript:;" data-num="1" data-type="1" data-id="434504" class="on btn_like zan-heart">
                                                    <span class="heart"></span>
                                                    <span class="frequency num" data-num="1">1次赞</span></a>
                                                <div class="head-portrait liked">
                                                    <a class="btn head-btn cls440617" href="/xbw2017">
                                                        <img src="https://head.artand.cn/440617/4826/128" class="photo"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="back-top-top"></div>
        </div>
    </div>
@endsection