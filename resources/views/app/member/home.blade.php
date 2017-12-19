@extends('app.layouts.cateyeartv2')

@section('style')
<link href="https://cdn.bootcss.com/jquery.swipebox/1.4.4/css/swipebox.min.css" rel="stylesheet">
<style>
.person-desc h3{ text-align: center; font-size: .5rem;}
.person-desc p{ font-size: .4rem; padding: .2rem;}
</style>
@endsection
@section('title', $member->name.'的猫眼艺术')

@section('content')
    <!-- 个人主页信息 -->
    <div class="homepage" @if(!empty($member->home_back)) style="background: url({{image_view2($member->home_back,410,235)}}) no-repeat; background-size:100% 100%" @endif>
        <a class="homep-a back" href="/">
            <span class="icon icon-back"></span>
        </a>
        <a class="homep-a homep-add syadd" href="javascript:;">
            <span class="icon icon-add"></span>
        </a>
        <div class="homepage-main">
            <div class="home-head" id="head-img"><img src="{{image_view2($member->avatar,100,100)}}" alt=""></div>
            <h1>{{$member->name}}</h1>
            <h1>作品{{$work_count}}  /    粉丝{{$follow_count}} </h1>
            @if($me->id != $member->id)
            <div class="home-btns clearfix">
                @if($me->id != $member->id)
                    @if(!is_login())
                        <a href="{{route('login')}}" class="gzbtn">关注</a>
                    @elseif(empty($is_followed))
                        <a id="btn_follow" href="{{route('api_member_star',$member->id)}}" class="gzbtn ajax-get" submit_success="star_success">关注</a>
                    @else
                        <a id="btn_follow" href="{{route('api_member_star',$member->id)}}" class="gzbtn follow_btn"  submit_success="unstar_success">关注</a>
                    @endif

                @endif
                <a class="fr" href="{{route('member_msg_info',$member->id)}}">私信</a>
            </div>
            @endif
            <span class="area-right" id="city">
                <i class="icon site-icon"></i>
            </span>

        </div>
    </div>

        <div class="home-title">
        <div id="t-header" class="clearfix">
            <div class="swiper-slide">
                <a data-type="album" href="javascript:;" class="on" data-load="true">主页</a>
                <a data-type="work" href="{{route('member_works',$member->id)}}">作品</a>
                <a href="javascript:;">展览</a>
                <a href="javascript:;">售卖</a>
                <a data-type="member_contenst" href="{{route('member_contents',$member->id)}}">文章</a>
                <a data-type="air_circle" href="{{route('member_moments',$member->id)}}">圈子</a>
            </div>
        </div>
    </div>

    <!-- 主页 -->
    <div class="h-zy" id="content">
        <div class="tabs">
            <div class=" album active">
                <div class="person-desc">
                    @if($me->id != $member->id)
                        <h3>个人简介<span class="icon icon-edit"></span></h3>
                        <p>{{$member->desc}}</p>
                    @else
                        <a href="{{route('member_info')}}">
                            <h3>个人简介<span class="icon icon-edit"></span></h3>
                            <p>{{$member->desc}}</p>
                        </a>
                    @endif
                </div>
                <div class="hot-pro-tit" style="margin-left: 0;">作品集</div>
                <div class="zy-two clearfix">
                @foreach($album_list as $key=>$album)
                    <a style="position: relative;" href="@if($me->id == $member->id){{route('member_album_info',$album->id)}}@else {{route('works_list_album',$album->id)}}@endif">
                        @if($me->id == $member->id)
                        <span data-title="确定要删除吗?" data-msg="删除后无法恢复" url="{{route('api_album_delete',$album->id)}}" class="icon icon-delete ajax-get confirm" style="position: absolute; bottom:0; right: 0; color: #ca4149;font-size: .6rem;"></span>
                        @endif
                        <img src="{{$album->pic}}" alt="">
                        <h1>{{$album->name}}</h1>
                        <p>{{$album->count}}件作品</p>
                    </a>
                    @if($key > 0 && $key % 2 == 1)
                    </div>
                    <div class="zy-two clearfix">
                    @endif
                @endforeach
                </div>
            </div>

            <div class="work"></div>
            <div class="air_circle"></div>
            <div class="member_contenst"></div>
        </div>
    </div>

    <form action="{{route('api_member_pic')}}" class="ajax-form" submit_success="change_pic">
        <input name="pic_url" type="hidden" id="pic-url">
        <input name="pic_type" type="hidden" id="pic-type">
    </form>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script src="http://img1.huapinhua.com/xbw.js?20170804"></script>
    <script src="http://img1.huapinhua.com/city_all.js?20170623"></script>
    <script src="https://cdn.bootcss.com/jquery.swipebox/1.4.4/js/jquery.swipebox.js"></script>
    <script>

        $('a.swipebox').swipebox();

        @if($me->id != $member->id)
        function star_success(obj) {
            obj.addClass('follow_btn').removeClass('ajax-get').attr('submit_success','unstar_success').text('关注');
        }
        function unstar_success() {
            $('#btn_follow').removeClass('follow_btn').addClass('ajax-get').attr('submit_success','star_success').text('关注');
        }
        @else

        function change_pic(form,resp) {

            if(resp.data.pic_type == 'avatar'){

                $('#head-img img').attr('src',resp.data.pic_url);
            }else{
                $('.homepage').css({
                    "padding":"5px",
                    "background":"url("+resp.data.pic_url+") no-repeat",
                    "background-size":"100% 100%"
                });
            }
        }
        @endif

        $(function () {

            $('.swiper-slide a').click(function(){

                var $this = $(this);
                var cls = $this.data('type');
                if(cls == null){
                    return false;
                }
                if($this.data('load')){

                    $this.addClass('on').siblings().removeClass('on');
                    $('#content .tabs>div').removeClass('active');
                    $('#content .tabs .'+cls).addClass('active');
                }else{

                    $.showPreloader();
                    $.get(this.href,function(_html){
                        $this.addClass('on').siblings().removeClass('on');
                        $this.data('load',true);
                        $('#content .tabs>div').removeClass('active');
                        $('#content .tabs .'+cls).html(_html).addClass('active')
                        $.hidePreloader();
                    },'html');
                }
                return false;
            });

            @if($me->id != $member->id)
            $(document).on('click','.follow_btn',function(){
                var group = [{
                    text: '<a href="{{route('api_member_star',$member->id)}}" class="ajax-get" submit_success="unstar_success">取消关注</a>',
                    color: 'danger',
                    close: false
                },
                    {
                        text: '取消'
                    }];
                var modal = $.actions([group]);
                return false;
            });
            @endif

            @if($me->id == $member->id)
            $('.homepage-main').on('click',
                function() {
                    var group = [{
                        "text": '更换头像<input id="avatar" class="file upload-btn" accept="image/*" multiple="multiple" type="file">',
                        'close': false
                    },{
                        "text": '更换背景<input id="home_back" class="file upload-btn" accept="image/*" multiple="multiple" type="file">',
                        'close': false
                    },
                    {
                        "text": '取消'
                    }];
                    var modal = $.actions([group]);

                    $.pic_upload('.upload-btn',function(res,obj) {
                        console.log("成功：" + JSON.stringify(res));
                        $('#pic-type').val(obj.attr('id'))
                        $('#pic-url').val(cat.cdn_domain+res.key).closest('form').submit();
                    });

                    return false;
            });
            @endif

//            var swiper = new Swiper('.swiper-container', {
//                slidesPerView: 'auto',
//                spaceBetween: 0,
//                loop: false,
//                initialSlide: 0,
//                onSlideChangeEnd: function(args) {}
//            });

            $('#city').append(XBW.linkage.findVbyK('{{$member->city_id}}' || '{{$member->province_id}}')[1]);
        })
    </script>
@endsection