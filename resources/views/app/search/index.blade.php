@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/search.css') }}">
@endsection

@section('title', '猫眼艺术')
@section('body-style', 'search-body search-string')
@section('content')
    <div class="page-group">
        <div class="page page-current">
            <header class="bar bar-nav nav-search nav-search-warks">
                <form id="search">
                    <div class="nav-s-warp">
                        <div class="searchbar">
                            <div class="search-input">
                                <div class="icon icon-search-a"></div>
                                <div class="s-input-tab-txt btn-type-trigger">作品</div>
                                <input type="search" placeholder="输入关键字..." class="search q" autocomplete="off" value="" name="q">
                                <a class="sbar-cancel hide btn-input-clear"></a>
                            </div>
                            <div class="searchbtn-warp">
                                <a class="seek-btn btn_cancel">取消</a></div>
                            <div class="search-show-box btn-type-panel" style="display: none;">
                                <div class="up_arrow"></div>
                                <div class="search-s-box">
                                    <label class="item-title">
                                        <input type="radio" value="user" name="type" data-label="找人" class="hide" autocomplete="off">
                                        <span class="icon user-icon"></span>找人</label>
                                    <label class="item-title">
                                        <input type="radio" value="work" name="type" data-label="作品" class="hide" autocomplete="off">
                                        <span class="icon work-icon"></span>作品</label>
                                    {{--<label class="item-title">--}}
                                        {{--<input type="radio" checked="checked" value="article" name="type" data-label="文章" class="hide" autocomplete="off">--}}
                                        {{--<span class="icon essay-icon"></span>文章--}}
                                    {{--</label>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="new-search-tab bdr-bom filter-bar hide" style="display: hide;">
                        <ul>
                            <li data-target="category" class="new-change-eleven new-sort-integrative integrative">
                            <span>
                                <s data-lable="类别">类别</s>
                                <i class="triangle"></i>
                            </span>
                            </li>
                            {{--<li data-target="label" class="new-change-eleven new-sort-integrative integrative1">--}}
                            {{--<span>--}}
                                {{--<s data-lable="题材">题材</s>--}}
                                {{--<i class="triangle"></i>--}}
                            {{--</span>--}}
                            {{--</li>--}}
                            <li data-target="sort" class="new-change-eleven new-sort-integrative integrative2">
                            <span>
                                <s data-lable="排序">排序</s>
                                <i class="triangle"></i>
                            </span>
                            </li>
                            <li data-target="filter" class="new-change-eleven new-sort-integrative integrative3">
                            <span>
                                <s>筛选</s>
                            </span>
                            </li>
                        </ul>
                    </div>
                    <div class="integrative-box show-position clearfix area-box  filter-list hide" style="display: none;">
                        <ul class="integrative-list" id="category">
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">全部</span></span>
                                    <input type="radio" name="subject" value="0" autocomplete="off"></label>
                            </li>
                            @foreach ($categorys as $cate)
                                <li class="sidebar-iteam" data-is-end="1">
                                    <label>
                                        <span>
                                            <i class="tick"></i>
                                            <span class="sort-of-brand">{{$cate['category_name']}}</span>
                                        </span>
                                        <input type="radio" name="subject" value="{{$cate['id']}}" autocomplete="off">
                                    </label>
                                </li>
                            @endforeach


                        </ul>
                        <ul class="integrative-list" id="label">
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">全部</span></span>
                                    <input type="radio" name="label" value="0" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">人物</span></span>
                                    <input type="radio" name="label" value="23" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">人体</span></span>
                                    <input type="radio" name="label" value="24" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">动物</span></span>
                                    <input type="radio" name="label" value="21" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">植物</span></span>
                                    <input type="radio" name="label" value="45" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">静物</span></span>
                                    <input type="radio" name="label" value="26" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">自然风景</span></span>
                                    <input type="radio" name="label" value="20" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">城市景观</span></span>
                                    <input type="radio" name="label" value="28" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">少女</span></span>
                                    <input type="radio" name="label" value="31" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">萌萌哒</span></span>
                                    <input type="radio" name="label" value="30" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">儿童</span></span>
                                    <input type="radio" name="label" value="32" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">宗教</span></span>
                                    <input type="radio" name="label" value="46" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">戏曲戏剧</span></span>
                                    <input type="radio" name="label" value="49" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">写实</span></span>
                                    <input type="radio" name="label" value="34" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">抽象</span></span>
                                    <input type="radio" name="label" value="27" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">科幻</span></span>
                                    <input type="radio" name="label" value="47" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">动漫风</span></span>
                                    <input type="radio" name="label" value="48" autocomplete="off"></label>
                            </li>
                        </ul>
                        <ul class="integrative-list" id="sort">
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">默认排序</span></span>
                                    <input type="radio" name="sort" value="" autocomplete="off"></label>
                            </li>
                            <li class="sidebar-iteam" data-is-end="1">
                                <label>
                                <span>
                                    <i class="tick"></i>
                                    <span class="sort-of-brand">最新发布</span></span>
                                    <input type="radio" name="sort" value="mtime" autocomplete="off"></label>
                            </li>
                            {{--<li class="sidebar-iteam" data-is-end="1">--}}
                                {{--<label>--}}
                                {{--<span>--}}
                                    {{--<i class="tick"></i>--}}
                                    {{--<span class="sort-of-brand">价格由低到高</span></span>--}}
                                    {{--<input type="radio" name="sort" value="asc" autocomplete="off"></label>--}}
                            {{--</li>--}}
                            {{--<li class="sidebar-iteam" data-is-end="1">--}}
                                {{--<label>--}}
                                {{--<span>--}}
                                    {{--<i class="tick"></i>--}}
                                    {{--<span class="sort-of-brand">价格由高到低</span></span>--}}
                                    {{--<input type="radio" name="sort" value="des" autocomplete="off"></label>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                    <div class="extral"></div>
                </form>
            </header>
            <form class="sx-popCover filter-panel hide" id="filter" style="display: none;">
                <div class="sidebar-header">
                    <div class="sidebar-header-left arrow-left btn-cancel">
                        <span>取消</span></div>
                    <div class="sidebar-header-center">
                        <span>筛选</span></div>
                    <div class="sidebar-header-right btn-submit">
                        <span>确定</span></div>
                </div>
                {{--<div class="sidebar-list">--}}
                    {{--<div class="sift-row">--}}
                        {{--<div class="row-head siftRowex">--}}
                            {{--<span class="row-title">价格</span>--}}
                            {{--<span class="selected-items"></span>--}}
                            {{--<span class="icons-sift-down switch-btn"></span>--}}
                        {{--</div>--}}
                        {{--<div class="row-body">--}}
                            {{--<ul class="clearfix">--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="全部" autocomplete="off" value="0">全部</label></li>--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="800元以下" autocomplete="off" value=",800">800元以下</label></li>--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="800~2000元" autocomplete="off" value="800,2000">800~2000元</label></li>--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="2000~5000元" autocomplete="off" value="2000,5000">2000~5000元</label></li>--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="5000~1万元" autocomplete="off" value="5000,10000">5000~1万元</label></li>--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="1万~3万元" autocomplete="off" value="10000,30000">1万~3万元</label></li>--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="5万~10万元" autocomplete="off" value="50000,100000">5万~10万元</label></li>--}}
                                {{--<li class="sift-item ">--}}
                                    {{--<label>--}}
                                        {{--<input type="radio" name="price" data-label="10万元以上" autocomplete="off" value="100000,">10万元以上</label></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="sidebar-list">
                    <div class="sift-row">
                        <div class="row-head siftRowex">
                            <span class="row-title">尺寸</span>
                            <span class="selected-items"></span>
                            <span class="icons-sift-down switch-btn"></span>
                        </div>
                        <div class="row-body">
                            <ul class="clearfix">
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="全部" name="sizes" autocomplete="off" value="0">全部</label></li>
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="0~20cm" name="sizes" autocomplete="off" value="0,20">0~20cm</label></li>
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="20~50cm" name="sizes" autocomplete="off" value="20,50">20~50cm</label></li>
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="50~80cm" name="sizes" autocomplete="off" value="50,80">50~80cm</label></li>
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="80~120cm" name="sizes" autocomplete="off" value="80,120">80~120cm</label></li>
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="120~150cm" name="sizes" autocomplete="off" value="120,150">120~150cm</label></li>
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="150~200cm" name="sizes" autocomplete="off" value="150,200">150~200cm</label></li>
                                <li class="sift-item ">
                                    <label>
                                        <input type="radio" data-label="200cm以上" name="sizes" autocomplete="off" value="200,">200cm以上</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="sidebar-list">
                    <div class="sift-row">
                        <div class="row-head siftRowex">
                            <span class="row-title">年代</span>
                            <span class="selected-items"></span>
                            <span class="icons-sift-down switch-btn"></span>
                        </div>
                        <div class="row-body">
                            <ul class="clearfix">
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="全部" name="years" value="0">全部</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2017年" name="years" value="2017">2017年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2016年" name="years" value="2016">2016年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2015年" name="years" value="2015">2015年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2014年" name="years" value="2014">2014年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2013年" name="years" value="2013">2013年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2013~2015年" name="years" value="2013,2015">2013~2015年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2010~2013年" name="years" value="2010,2013">2010~2013年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="2000~2010年" name="years" value="2000,2010,">2000~2010年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="1990~2000年" name="years" value="1990,2000">1990~2000年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="1980~1990年" name="years" value="1980,1990">1980~1990年</label></li>
                                <li class="sift-item">
                                    <label>
                                        <input type="radio" autocomplete="off" data-label="1980以前" name="years" value=",1980">1980以前</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="sidebar-list">
                    <div class="sift-row">
                        <div class="row-head siftRowex">
                            <span class="row-title">地区</span>
                            <span class="selected-items"></span>
                            <span class="icons-sift-down switch-btn"></span>
                        </div>
                        <div class="row-body">
                            <ul class="clearfix" id="city-wrap">
                                <li class="sift-item">
                                    <label>全部
                                        <input type="radio" data-label="全部" name="province_id" value="0">
                                        <input type="radio" name="province_id" value="0"></label>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                {{--<div class="sidebar-list">--}}
                    {{--<div class="sift-row">--}}
                        {{--<div class="row-head siftRowex">--}}
                            {{--<span class="row-title">只看可售作品</span>--}}
                            {{--<span class=" switch-btn margin-t3">--}}
                            {{--<div class="item-input">--}}
                                {{--<label class="label-switch">--}}
                                    {{--<input type="checkbox" name="is_sale" autocomplete="off" value="1">--}}
                                    {{--<div class="checkbox"></div>--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </form>
            <div class="content infinite-scroll native-scroll">
                <div class="content-block clearfix result" style="display: block;">
                    <div class="list-block">
                        <div class="search-list larger-view">
                            <ul class="page-container">

                            </ul>
                        </div>
                        {{--<div class="suggest-list larger-view hide" style="display: none;">--}}
                            {{--<div class="empty-recommend">--}}
                                {{--<span>为你推荐</span></div>--}}
                            {{--<ul class="page-container"></ul>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
            <div class="cover-floor cover hide" style="z-index: 100;"></div>
        </div>
    </div>
@endsection


@section('scripts')
<script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
<script src="http://img1.huapinhua.com/xbw.js?20170804"></script>
<script src="http://img1.huapinhua.com/city_all.js?20170623"></script>
<script>

    var click_obj;
    function star_success(obj) {
        obj.addClass('follow_btn').removeClass('ajax-get');
    }
    function unstar_success() {
        click_obj.removeClass('follow_btn').addClass('ajax-get');
    }
    $(function () {

        $(document).on('click','.follow_btn',function(){
            click_obj = $(this);
            var group = [{
                text: '<a href="'+click_obj.data('url')+'" class="ajax-get" submit_success="unstar_success">取消关注</a>',
                color: 'danger',
                close: false
            },
                {
                    text: '取消'
                }];
            var modal = $.actions([group]);
            return false;
        });
    });

    var _li_html = '';
    $.each(XBW.linkage.data[100],function(value,text){
        _li_html += '<li class="sift-item">' +
                '<label>' +text+
                '<input type="radio" data-label="'+text+'" name="province_id" value="'+value+'">' +
                '</label>' +
                '</li>';
    });
    $('#city-wrap').append(_li_html);

    var TMPL = {
        'EMPTY': '<div class="empty-warp empty-user"><div class="icon icon-empty"></div><p class="text-empty-h3">没有找到相关内容</p></div>',
        'END': '<li class="the-end-li end"><div class="the-end-box"><div><span>The End</span></div></div></li>'
    };

    var $form = $('#search'),
            $cover = $('.cover').css('zIndex', 100),
            $body = $('body'),
            $clear = $('.btn-input-clear', $form),
            $q = $('input.q', $form),
            $history = $('.history'),
            $search = $('.search-list'),
            $suggest = $('.suggest-list'),
            $ul = $('ul', $search),
            $filterBar = $('.filter-bar', $form),
            $barPanel = $('.filter-panel'),
            $barDrop = $('.filter-list'),
            lastData, itv, xhr, $w = $('.content');
            $body = $('body');

    var $dropDown = $('.btn-type-trigger'),
            $pannel = $('.btn-type-panel');

    var isLoad = false, url = '';

    var resetFilter = function() {
        if (getType() == 'work') {
            var $li = $('li', $filterBar).removeClass('checked');
            $('input:checked', $li).prop('checked', false);
            $('s[data-lable]', $li).text(function() {
                return $(this).attr('data-lable')
            });
        }
        return false;
    }

    var toggleFilterBar = function(val) {
        $filterBar.toggle(getType() == 'work' && val.length > 0 ? true: false);
    }

    $q.on('input',function(ev) {
        var val = $.trim($(this).val());
        $clear.toggle( !! val.length);
//        if (val.length) {
//            hideHistory();
//        } else {
//            showHistory();
//        }
        if (isDirty()) {
            $form.trigger('search');
            resetFilter();
        }
        toggleFilterBar(val);

        $pannel.hide();
        $barPanel.hide();
        $barDrop.hide();
    }).on('click focus',function() {
        $q.trigger('input');
    });

    $clear.on('click',function() {
                $q.val('');
                $q.trigger('input');
                return false;
            });

    var getType = function() {
        return $('input[name=type]:checked', $form).val();
    }

    var isDirty = function() {
        var data = $form.serialize(),dirty;
        if (data == lastData) {
            dirty = false;
        } else {
            dirty = true;
            lastData = data;
        }
        return dirty;
    }

    $dropDown.on('click',function(ev) {
        $pannel.toggle();
        return false;
    });

    $pannel.on('click', 'input',function(ev) {
        var $this = $(this),
            text = $this.attr('data-label'),
            val = $.trim($this.val());
        $dropDown.text(text);
        $pannel.hide();
        $q.trigger('input');
        if (val == 'work') {
            $body.addClass('search-string').removeClass('search-essay');
        } else {
            $body.addClass('search-essay').removeClass('search-string');
        }
        return;
    });

    var showResult = function(result) {
        if (result) {
            var html = result.data.html ? result.data.html: TMPL.EMPTY;
            $('ul', $search).html(html);
            XBW.linkage.cityId2String($('ul', $search));
//            if (result.data.html && !result.data.last_id && !$('li.end', $ul).length) {
//                $ul.append(TMPL.END);
//            }
//            layzLoad($search);
//            result.suggest = result.suggest || {};
//            $('ul', $suggest).html(result.suggest.html || '');
//            layzLoad($suggest);
        } else {
            $('ul', $search).empty();
        }
//        $CONF['last_id'] = result.search.last_id || 0;
//        $suggest.toggle(result && result.suggest && result.suggest.html ? true: false);
    }

    $form.on('search',function(ev) {
        var val = $.trim($q.val());
        if (val.length) {
            $form.trigger('submit');
        } else {
            $ul.empty();
            $('ul', $suggest).empty();
        }
    }).on('submit',function(ev) {
        var data = $form.serialize();

        $.get('{{route('search')}}',data,function(result){
            if (result) {
                if (result.status == 0) {
                    showResult(result);
                } else {
                    $.toast(result.msg, '', 'error');
                }
            }
            $.hideIndicator();

        },'json');
        return false;
    });
    var $activeTab;

    $filterBar.on('click', 'li',function(ev) {
        var $this = $(this),
            id = $this.attr('data-target'),
            $target = $('#' + id);
        $pannel.hide();
        if ($this.hasClass('active')) {
            $barPanel.hide();
            $barDrop.hide();
            $this.removeClass('active');
            $cover.hide();
            return;
        }
        if (id == 'filter') {
            $barPanel.show();
            $barDrop.hide();
            $cover.show();
        } else {
            $target.show().siblings().hide();
            $barPanel.hide();
            $barDrop.show();
            $this.addClass('active')
        }
        $this.siblings().removeClass('active');
        $activeTab = $this;
        return;
    });
    $barDrop.on('click', 'li',function(ev) {
        var $this = $(this),
            $input = $('input', $this),
            text = $.trim($this.text());
        $input.prop('checked', true);
        $this.addClass('checked').siblings('.checked').removeClass('checked');
        if (isDirty()) {
            $form.trigger('search');
        }
        $activeTab.removeClass('active');
        $('s', $activeTab).text(text);
        $barDrop.hide();
        $cover.hide();
        return false;
    });
    $barPanel.on('click', '.btn-cancel',function() {
        $barPanel.hide();
        $cover.hide();
        return false;
    }).on('click', 'input[type=radio]',function() {
        var $this = $(this),
                label = $this.attr('data-label'),
                cls = 'sift-item-selected',
                $li = $this.closest('li'),
                $parent = $this.closest('.sidebar-list'),
                $prev = $('.selected-items', $parent);
        if ($li.hasClass(cls)) {
            $prev.text('');
            $li.removeClass(cls);
        } else {
            $prev.text(label);
            $li.addClass(cls).siblings().removeClass(cls);
        }
        return;
    }).on('click', '.switch-btn',function(ev) {
        var $this = $(this),
            $parent = $this.closest('.sift-row');
            $parent.toggleClass('sift-row-expand');
        return;
    }).on('click', '.btn-submit',function(ev) {
        var $clone = $barPanel.children().clone(true);
        $('div.extral').empty().append($clone);
        $form.trigger('submit');
        $cover.hide();
        $barPanel.hide();
        return false;
    })

    $(document).on('infinite', '.infinite-scroll',function() {
        if (isLoad) {
            return false;
        } else {
            isLoad = true;
        }
        if(url == '' || url == null){
            return false;
        }
        $.get(url,function(resp){

            isLoad = false;
            if(resp.status == '0'){
                showResult(resp)
            }
            if(resp.url){
                url = resp.url;
            }else{
                $('.infinite-scroll-preloader').remove();
                url = null;
            }
        },'json');
    });
</script>
@endsection