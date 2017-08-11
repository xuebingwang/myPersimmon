@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/member.css') }}?2017062311">
@endsection
@section('title', '个人中心-修改密码')
@section('body-style', 'site-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <div class="content native-scroll">
                <form action="{{route('api_member_privacy')}}" class="list-block privacy-li-block ajax-form" id="privacy">
                    <header class="bar bar-nav">
                        <a class="button button-link button-nav pull-left back"></a>
                        <h1 class="title">隐私</h1>
                        <button type="submit" class="button pull-right save-btn btn-submit">确定</button>
                    </header>
                    <div class="content native-scroll site-content privacy-li-content">
                        <ul class="f8 margin-bottom-12">
                            <li>
                                <div class="item-content">
                                    <div class="item-inner ">
                                        <div class="item-title label">公开我赞过的内容</div>
                                        <div class="item-input">
                                        <span class=" switch-btn">
                                            <label class="label-switch">
                                                <input autocomplete="off" type="checkbox" value="y" @if($member->is_show_liked == \App\CatEyeArt\Common::YES) checked="checked" @endif name="is_show_liked">
                                                <div class="checkbox"></div>
                                            </label>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner ">
                                        <div class="item-title label">公开我的藏品</div>
                                        <div class="item-input">
                                        <span class=" switch-btn">
                                            <label class="label-switch">
                                                <input autocomplete="off" type="checkbox" value="y" @if($member->is_show_collect == \App\CatEyeArt\Common::YES) checked="checked" @endif name="is_show_collect">
                                                <div class="checkbox"></div>
                                            </label>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}?20170623"></script>
@endsection