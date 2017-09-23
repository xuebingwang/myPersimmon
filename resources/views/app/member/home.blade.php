@extends('app.layouts.cateyeartv2')

@section('title', $member->name.'的猫眼艺术')

@section('content')
    <!-- 个人主页信息 -->
    <div class="homepage">
        <a class="homep-a homep-return back" href="javascript:;"></a>
        <a class="homep-a homep-add" href="javascript:;"></a>
        <div class="homepage-main">
            <div class="home-head" id="head-img"><img src="{{image_view2($member->avatar,100,100)}}" alt=""></div>
            <h1>{{$member->name}}</h1>
            <h1>作品{{$works->total()}}  /    粉丝{{$follow_count}} </h1>
            @if($me->id != $member->id)
            <div class="home-btns clearfix">
                @if($me->id != $member->id)
                    @if(!is_login())
                        <a href="{{route('login')}}" class="gzbtn">关注</a>
                    @elseif(empty($is_followed))
                        <a id="btn_follow" href="{{route('api_member_star',$member->id)}}" class="gzbtn ajax-get" submit_success="star_success">关注</a>
                    @else
                        <a id="btn_follow" href="{{route('api_member_star',$member->id)}}" class="gzbtn follow_btn"  submit_success="unstar_success">已关注</a>
                    @endif

                @endif
                <a class="fr" href="javascript:;">私信</a>
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
                <a data-type="work" href="javascript:;" class="on" data-load="true">主页</a>
                <a data-type="album" href="{{route('member_album',$member->id)}}">作品集</a>
                <a href="javascript:;">展览</a>
                <a href="javascript:;">原创已售</a>
                <a href="javascript:;">授权版画</a>
                <a href="javascript:;">朋友圈</a>
            </div>
        </div>
    </div>

    <!-- 主页 -->
    <div class="h-zy" id="content">
        <div class="tabs">
            <div class=" work active">
                @foreach($works as $work)
                <div class="zy-one">
                    <a href="{{route('work_info',$work->id)}}">
                        <img src="{{image_view2($work->pic,390,235)}}" alt="">
                        <h1>{{$work->name}}</h1>
                        <p>{{show_work_params($work)}}</p>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="album"></div>
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
    {{--<script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.min.js"></script>--}}
    <script>

        @if($me->id != $member->id)
        function star_success(obj) {
            obj.addClass('follow_btn').removeClass('ajax-get').attr('submit_success','unstar_success').text('已关注');
        }
        function unstar_success() {
            $('#btn_follow').removeClass('follow_btn').addClass('ajax-get').attr('submit_success','star_success').text('关注');
        }
        @else
        function change_avatar(form,resp) {

            $('#head-img img').attr('src',resp.data.avatar);
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
                    text: '<a href="{{route('api_member_star',$member->mid)}}" class="ajax-get" submit_success="unstar_success">取消关注</a>',
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