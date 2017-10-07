@extends('app.layouts.cateyeartv2')

@section('title', '联系人-粉丝')
@section('content')

    <!-- header start -->
    <div class="sy-header">
        <div class="sy-head-top clearfix">
            <a class="homep-a homep-return back" href="javascript:;"></a>
            <h1>联系人</h1>
        </div>
    </div>
    <div style="height: 1.45rem"></div>

    <div class="tab-title-wrap">
        <div class="tab-title">
            <span class="title-num">1</span>
            <span class="title-text">粉丝</span>
        </div>
        <div class="tab-title">
            <span class="title-num">1</span>
            <span class="title-text">关注</span>
        </div>
        <div class="tab-title">
            <span class="title-num">1</span>
            <span class="title-text">好友</span>
        </div>
    </div>
    <div class="friend-item-wrap">
        <div class="friend-item">
            <span class="friend-avatar">
                <img class="hothead" src="http://img1.huapinhua.com/bpneodase9aikrf1dtyfvl5wmi.jpg?imageView2/1/w/80/h/80/interlace/1&amp;e=1507363801?imageMogr2/thumbnail/!80x80!" alt="">
            </span>
            <div class="friend-name">
                <b>王兵兵</b>
                <span>47件作品</span>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
@endsection
