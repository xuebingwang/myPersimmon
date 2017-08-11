@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/member.css') }}?2017062311">
@endsection
@section('title', '个人中心-个人资料')
@section('body-style', 'site-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <div class="content native-scroll">
                <form action="{{route('api_member_info')}}" class="list-block site-li-block ajax-form" id="account">
                    <header class="bar bar-nav">
                        <a class="button button-link button-nav pull-left back" href="/"></a>
                        <h1 class="title">个人资料</h1>
                        <button class="button pull-right save-btn btn-submit">保存</button>
                    </header>
                    <div class="content native-scroll site-content site-li-content">

                        <ul class="f8 data-ul">
                            <li>
                                <div class="item-content">
                                    <div class="item-inner ">
                                        <div class="item-title label">昵称</div>
                                        <div class="item-input">
                                            <input type="text" class="name" name="name" value="{{$member->name}}" placeholder="请输入"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label label-55">个人域名
                                            <span>cateyeart.com/</span></div>
                                        <div class="item-input">
                                            <input type="text" class="domain" name="domain" value="{{$member->domain}}" placeholder="请输入"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner item-inner-right">
                                        <div class="item-title label">性别</div>
                                        <div class="item-input">
                                            <select name="sex">
                                                @foreach( \Models\Members::$sex_array as $key=>$val)
                                                    <option value="{{$key}}" @if($member->sex == $key) selected="selected" @endif>{{$val}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner item-inner-right">
                                        <div class="item-title label">生日</div>
                                        <div class="item-input">
                                            <input type="date" name="birthday" class="calendar" value="{{$member->birthday}}"></div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">城市</div>
                                        <div class="item-input"></div>
                                    </div>
                                </div>
                                <div class="item-content-under city">
                                    <input type="hidden" name="country_id">
                                    <input type="hidden" name="province_id">
                                    <input type="hidden" name="city_id">
                                    <ul>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner ">
                                                    <div class="item-title label">省</div>
                                                    <div class="item-input item-inner-right">
                                                        <select id="province_id" name="province_id" class="province_id" data-influence="city_id" data-empty_text="请选择省份">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner ">
                                                    <div class="item-title label">市</div>
                                                    <div class="item-input item-inner-right">
                                                        <select id="city_id" name="city_id" class="city_id" data-influence="area_id" data-empty_text="请选择市">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner ">
                                                    <div class="item-title label">区/县</div>
                                                    <div class="item-input item-inner-right">
                                                        <select id="area_id" name="area_id" class="area_id" data-empty_text="请选择区/县">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-title label">个人简介</div>
                                        <div class="item-input"></div>
                                    </div>
                                </div>
                                <div class="item-content-uoder ">
                                    <textarea class="under-textarea" autocomplete="off" name="member_desc" maxlength="65535" placeholder="请输入你个人简介...">{{$member->desc}}</textarea></div>
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
    <script src="http://img1.huapinhua.com/xbw.js?20170804"></script>
    <script src="http://img1.huapinhua.com/city_all.js?20170623"></script>
    <script>

        $(function () {
            XBW.linkage.init({
                el      : 'province_id',
                root    : 100,
                emptyText: '请选择',
                selected: '{{$member->area_id}}',
                callback:function () {
                        //zepto写法
//                    console.info(this.find("option").eq(this.attr("selectedIndex")).text());
                        //jquery写法
//                    var selOptionTxt = this.find("option:selected").text();
                }
            });
        })
    </script>
@endsection