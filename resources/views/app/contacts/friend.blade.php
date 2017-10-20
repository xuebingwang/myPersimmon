@extends('app.layouts.cateyeartv2')

@section('title', '联系人-粉丝')
@section('content')

    <!-- header start -->
    <div class="sy-header">
        <div class="sy-head-top clearfix">
            <a class="homep-a back" href="javascript:history.back();">
                <span class="icon icon-back"></span>
            </a>
            <h1>我的朋友</h1>
        </div>
    </div>
    <div style="height: 1.45rem"></div>

    <div class="friend-menu  clearfix">
        <a class="" href="{{route('member_contacts_fans')}}">
            <span class="title-num">{{$total_list['fans']}}</span>
            <span class="menu-text">粉丝</span>
        </a>
        <a class="" href="{{route('member_contacts_gz')}}">
            <span class="title-num num-text">{{sizeof($total_list['gz'])}}</span>
            <span class="menu-text">关注</span>
        </a>
        <a class="on" href="javascript:">
            <span class="title-num">{{$total_list['friend']}}</span>
            <span class="menu-text">好友</span>
        </a>
    </div>

    <div class="friend-item-wrap">
        @foreach($list as $item)
            <div class="friend-item">
                <div class="friend-avatar">
                    <a href="{{route('php',$item->id)}}">
                        <img class="hothead" src="{{image_view2($item->avatar,80,80)}}" alt="">
                    </a>
                </div>
                <div class="friend-name">
                    <b>{{$item->name}}</b>
                    <span>47件作品</span>
                </div>
                <div class="btn-wrap">
                    <a class="gzbtn" href="{{route('member_msg_info',$item->id)}}" title="">私信</a>
                </div>
                <div class="clear"></div>
            </div>
        @endforeach
    </div>

@endsection
