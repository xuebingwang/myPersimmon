@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/home.css') }}">
@endsection
@section('title', $member->name.'的猫眼艺术')
@section('body-style', 'homepage-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <div class="content infinite-scroll native-scroll" data-distance="500">
                <section class="content-section">
                    <header class="bar bar-nav">
                        <a class="button button-link button-nav pull-left back" href="/"></a>
                        {{--<a class="button button-link button-nav pull-right share-btn btn-share"></a>--}}
                    </header>

                    <?php
                    $home_page = isset($member->domain) ? ('/'.$member->domain) : route('php',$member->id);
                    ?>
                    <div class="profile-head">
                        <div class="name-head edite-head">
                            <a id="head-img" class="h-btn my-head layz" style="background-image:url({{$member->avatar}})" href="javascript:"></a>
                        </div>
                    </div>
                    <div class="profile-text">
                        <h3>
                            <span>{{$member->name}}</span></h3>
                        <h4>
                        <span class="work-span">
                            <i>{{$works->total()}}</i>件作品</span>
                            <span>{{time_tran($member->last_login)}}</span>
                            <span class="area-left" id="city">
                                <i class="icon site-icon"></i>

                            </span>
                        </h4>
                    </div>
                    <div class="resume-box">
                        <p>
                            简介：{{$member->desc}}
                            <a href="javascript:" class="resume-btn-blue">[详情]</a>
                        </p>
                    </div>
                </section>
                <section class="content-navigation-box">
                    <div class="navigation Own-nav">
                        <div class="swiper-container swiper-container-horizontal">
                            <div class="swiper-wrapper">
                                <div class="work swiper-slide swiper-slide-active select">
                                    <a href="/{{$member->domain}}" class="slide-nav-btn" data-type="work" data-load="true">新作</a>
                                </div>
                                <div class="album swiper-slide">
                                    <a href="{{route('member_album',$member->id)}}" class="slide-nav-btn" data-type="album">作品集</a>
                                </div>
                                {{--<div class="article swiper-slide">--}}
                                    {{--<a href="/liuxg2018/article" data-type="article" class="slide-nav-btn">文章</a>--}}
                                {{--</div>--}}
                                {{--<div class="collect swiper-slide">--}}
                                    {{--<a href="/liuxg2018/collect" data-type="collect" class="slide-nav-btn">藏品</a>--}}
                                {{--</div>--}}
                                {{--<div class="feed swiper-slide">--}}
                                    {{--<a href="/liuxg2018/feed" data-type="feed" class="slide-nav-btn">动态</a>--}}
                                {{--</div>--}}
                                <div class="swiper-slide"></div>
                            </div>
                        </div>
                        {{--<a href="/liuxg2018/setting" class="set-nav-btn">--}}
                            {{--<div class="set-nav-box">--}}
                                {{--<span class="icon set-span"></span>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    </div>

                    <div class="navigation-content clearfix" id="content">
                        <div class="tabs">
                            <div class="work active">
                                @if($member->id == $me->id)
                                    <div class="attention-warp attention-w-new">
                                        <a href="{{route('member_work_add')}}" class="btn_add">
                                            <span>+</span> 发表作品
                                        </a>
                                    </div>
                                @endif
                                <div class="ul">
                                    @foreach($works as $work)
                                    <div class="recommend-item works">
                                        <a href="{{route('work_info',$work->id)}}">
                                            <div class="images-works" style="background-color: rgb({{mt_rand(0,255)}}, {{mt_rand(0,179)}}, {{mt_rand(0,179)}}); background-image: url('{{$work->pic}}');"></div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            {{--<div class="sale">--}}
                                {{--<div class="empty-warp">--}}
                                    {{--<div class="icon nav-empty-2"></div>--}}
                                    {{--<p class="text-empty-h3">你还没有出售中的作品</p>--}}
                                    {{--<a href="/write" class="btn btn-add-em">发布作品</a></div>--}}
                            {{--</div>--}}
                            <div class="album"></div>
                            {{--<div class="article"></div>--}}
                            {{--<div class="collect"></div>--}}
                            {{--<div class="feed"></div>--}}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <form action="{{route('api_member_avatar')}}" class="ajax-form" submit_success="change_avatar">
        <input name="avatar" type="hidden" id="avatar">
    </form>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script src="http://img1.huapinhua.com/xbw.js?20170804"></script>
    <script src="http://img1.huapinhua.com/city_all.js?20170623"></script>
    <script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.min.js"></script>
    <script>

        function change_avatar(form,resp) {

            $('#head-img').css('background-image','url('+resp.data.avatar+')');
        }
        $(function () {

            $('.swiper-slide a').click(function(){

                var $this = $(this);
                var cls = $this.data('type');
                $this.parent().addClass('select').siblings().removeClass('select');
                if($this.data('load')){

                    $('#content .tabs>div').removeClass('active');
                    $('#content .tabs .'+cls).addClass('active');
                }else{

                    $.get(this.href,function(_html){
                        $this.data('load',true);
                        $('#content .tabs>div').removeClass('active');
                        $('#content .tabs .'+cls).html(_html).addClass('active');
                    },'html');
                }
                return false;
            });

            $('#head-img').on('click',
                function() {
                    var group = [{
                        "text": '更换头像<input id="upload-head" class="file" accept="image/*" multiple="multiple" type="file">',
                        'close': false
                    },
                    {
                        "text": '取消'
                    }];
                    var modal = $.actions([group]);

                    $.pic_upload('#upload-head',function(res) {
                        console.log("成功：" + JSON.stringify(res));
                        $('#avatar').val(cat.cdn_domain+res.key).closest('form').submit();
                    });

                    return false;
            });

            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                loop: false,
                initialSlide: 0,
                onSlideChangeEnd: function(args) {}
            });

            $('#city').append(XBW.linkage.findVbyK('{{$member->city_id}}' || '{{$member->province_id}}')[1]);
        })
    </script>
@endsection