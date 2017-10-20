@extends('app.layouts.cateyeartv2')

@section('title', '联系人-粉丝')
@section('content')

    <!-- header start -->
    <div class="sy-header">
        <div class="sy-head-top clearfix">
            <a class="homep-a back" href="javascript:;">
                <span class="icon icon-back"></span>
            </a>
            <h1>我的朋友</h1>
        </div>
    </div>
    <div style="height: 1.45rem"></div>

    <div class="friend-menu  clearfix">
        <a class="@if($menu == 'fans') on @endif" href="{{route('member_contacts_fans')}}">
            <span class="title-num">{{$total_list['fans']}}</span>
            <span class="menu-text">粉丝</span>
        </a>
        <a class="@if($menu == 'gz') on @endif" href="{{route('member_contacts_gz')}}">
            <span class="title-num num-text">{{sizeof($total_list['gz'])}}</span>
            <span class="menu-text">关注</span>
        </a>
        <a class="" href="{{route('member_contacts_friend')}}">
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
                    <a class="gzbtn @if(in_array($item->id,$total_list['gz'])) follow_btn @endif ajax-get" href="{{route('api_member_star',$item->id)}}" title="" submit_success="do_star_success">关注</a>
                </div>
                <div class="clear"></div>
            </div>
        @endforeach
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>
        var num_text = $('.num-text');
        function do_star_success(obj,resp) {
            @if($menu == 'gz')
            obj.closest('.friend-item').remove();
            @else
            obj.toggleClass('follow_btn');
            @endif
            num_text.each(function(i,vv){
                vv = $(vv);
                var num = parseInt($.trim(vv.text()));

                if(resp.data.is_stared){
                    vv.text(++num);
                }else{
                    vv.text(--num);
                }
            });
        }
    </script>
@endsection
