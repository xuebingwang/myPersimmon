@extends('app.layouts.cateyeartv2')

@section('title', $item->title)
@section('style')
<style>
    .qqFace{margin-top:4px;background:#fff;padding:2px;border:1px #dfe6f6 solid; top: -3.8rem !important; left: 0 !important;}
    .qqFace table{ width: 100%;}
    .qqFace table td{padding:0px;}
    .qqFace table td img{cursor:pointer;border:1px #fff solid;}
    .qqFace table td img:hover{border:1px #0066cc solid;}
</style>
@endsection
@section('content')

    <div class="pagedetails">
        <div class="page-tit">{{$item->title}}</div>
        <div class="page-user clearfix">
            <img src="{{image_view2($item->avatar,50,50)}}" alt="">
            <div class="page-user-txt">
                <h1>{{$item->member_name}}</h1>
                <div class="page-user-bot clearfix">
                    <span>原创</span>
                    <p>{{time_tran($item->created_at)}}</p>
                    @if($me->id != $item->mid)
                        @if(!is_login())
                            <a href="{{route('login')}}" class="gzbtn">关注</a>
                        @elseif(empty($is_followed))
                            <a id="btn_follow" href="{{route('api_member_star',$item->mid)}}" class="gzbtn ajax-get" submit_success="star_success">关注</a>
                        @else
                            <a id="btn_follow" href="{{route('api_member_star',$item->mid)}}" class="gzbtn follow_btn"  submit_success="unstar_success">已关注</a>
                        @endif

                    @endif
                </div>
            </div>
        </div>
        <div class="page-txt">
            <?=$item->desc?>
        </div>
        <div class="liul">6205浏览</div>
        {{--<div class="liu-label clearfix">--}}
            {{--<span>艺术</span>--}}
            {{--<span>美术</span>--}}
            {{--<span>建筑</span>--}}
            {{--<span>文学</span>--}}
        {{--</div>--}}
        <div class="plove clearfix">

            @if(!is_login())
                <a href="{{route('login')}}" class="zan-heart btn_like "><span class="ploveicon"></span></a>
            @else
                <a href="{{route('api_content_like',$item->id)}}" class="zan-heart btn_like @if(in_array($me->id,$item->likes->keyBy('mid')->keys()->toArray())) on heartAnimation @else ajax-get @endif" submit_success="like_success">
                    <span class="ploveicon"></span>
                </a>
            @endif
            <div class="plove-lists clearfix">
                @foreach($item->likes as $like)
                    <a href="{{route('php',$like->mid)}}" class="cls{{$like->mid}}">
                        <img alt="" src="{{image_view2($like->avatar,60,60)}}" alt="">
                    </a>
                @endforeach
                <a href="javascript:" class="zan-count num">
                    <span>{{count($item->likes)}}</span>
                </a>
            </div>
            <a href="javascript:;" class="plove-more"></a>
        </div>
    </div>

    {{--<div class="zan-bfrt clearfix" style="text-align: center">--}}
        {{--<a class="bf1" href="javascript:;" style="text-align: left; float: none; display: inline-block;">赞赏</a>--}}
    {{--</div>--}}

    <div class="pl-lists">
        <ul id="comment_list">
            <?php
            $comments = $item->getComments();
            ?>
            @foreach($comments as $comment)
            <li>
                <div class="pltop clearfix">
                    <a href="@if(empty($comment->domain)){{route('php',$comment->mid)}}@else {{$comment->domain}}@endif">
                        <img alt="" src="{{image_view2($comment->avatar,60,60)}}" alt="">
                    </a>
                    <div class="pltop-txt">
                        <h1>
                            <a href="@if(empty($comment->domain)){{route('php',$comment->mid)}}@else {{$comment->domain}}@endif">
                            {{$comment->name}}
                            </a>
                        </h1>
                        <div class="plt"><?=ubb_replace($comment->content)?></div>
                    </div>
                    <div class="pltop-time clearfix">
                        <p>{{$comment->created_at}}</p>
                        {{--<span>回复</span>--}}
                    </div>
                    {{--<div class="plzan">6</div>--}}
                </div>
            </li>
            @endforeach
        </ul>
        @if($comments->total() > 5)
            <div class="more"><a style="border-top: 1px solid #f2f2f2; padding-top:0.3rem; font-size: 0.5rem;text-align: center;color: #555; display: block;" href="{{route('content_comment_list',$item->id)}}">查看更多</a></div>
        @endif
    </div>

    <form action="{{route('api_content_comment')}}" class="ajax-form comment" submit_success="add_comment_success">

        <input type="hidden" name="cid" value="{{$item->id}}">
        <div class="plfooter">
            <div class="plf-search">
                <input name="comment" id="comment-content" class="sipt" type="text" placeholder="写评论">
                <input id="comment-pid" type="hidden" name="pid" value="">
                <div class="plbq emotion"></div>
            </div>
            <div class="plf-links">
                {{--<button type="submit" class="gzbtn">发送</button>--}}
                <a id="comment-sb-btn" class="plft1" href="javascript:;"></a>
                {{--<a class="plft1" href="javascript:;"><span>2</span></a>--}}
                {{--<a class="plft2" href="javascript:;"></a>--}}
                {{--<a class="plft3" href="javascript:;"></a>--}}
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script type="text/javascript" src="/js/qqface/jquery.qqFace.js"></script>
    <script>
//        $.showPreloader();
//        $.confirm('aaaadsfafadfa');
        function add_comment_success(form,resp) {

            var _html = '<li>\
                            <div class="pltop clearfix">\
                                <a href="'+resp.data.domain+'">\
                                    <img alt="" src="'+resp.data.avatar+'" alt="">\
                                </a>\
                                <div class="pltop-txt">\
                                    <h1>\
                                        <a href="'+resp.data.domain+'">'+resp.data.member_name+'</a>\
                                    </h1>\
                                    <div class="plt">'+resp.data.content+'</div>\
                                </div>\
                                <div class="pltop-time clearfix">\
                                    <p>刚刚</p>\
                                </div>\
                            </div>\
                        </li>';
            $('#comment-content,#comment-pid').val('');

            $('#comment_list').prepend(_html);
        }
        @if($me->id != $item->mid)
        function star_success(obj) {
            obj.addClass('follow_btn').removeClass('ajax-get').attr('submit_success','unstar_success').text('已关注');
        }
        function unstar_success() {
            $('#btn_follow').removeClass('follow_btn').addClass('ajax-get').attr('submit_success','star_success').text('关注');
        }
        $(function () {
            $(document).on('click','.follow_btn',function(){
                var group = [{
                    text: '<a href="{{route('api_member_star',$item->mid)}}" class="ajax-get" submit_success="unstar_success">取消关注</a>',
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
        @endif
        @if(!empty($me))

        function like_success(obj) {
            obj.addClass('on heartAnimation').removeClass('ajax-get');
            $('.zan-count').before('<a href="{{route('php',$me->id)}}" class="cls{{$me->id}}">' +'<img alt="" src="{{image_view2($me->avatar,60,60)}}" class="photo"></a>');

            var count = parseInt($('.zan-count span').text());
            $('.zan-count span').text(++count);
        }

        function unlike_success(obj) {
            $('.btn_like').removeClass('on heartAnimation').addClass('ajax-get');
            $('.plove-lists .cls{{$me->id}}').remove();
            var count = parseInt($('.zan-count span').text());
            $('.zan-count span').text(--count);

        }
        @endif
        $(function () {
            $('.emotion').qqFace({
                assign:'comment-content', //给输入框赋值
                path:'/js/qqface/arclist/'    //表情图片存放的路径
            });

            $(document).on('click','.heartAnimation',function(){
                var group = [{
                    text: '<a href="{{route('api_content_like',$item->id)}}" class="ajax-get" submit_success="unlike_success">不喜欢了</a>',
                    color: 'danger',
                    close: false
                },
                    {
                        text: '取消'
                    }];
                var modal = $.actions([group]);
                return false;
            })

            @if($me->id == $item->mid)
                $('.btn-mange').click(function(){
                    var group = [{
                        text: '<a href="{{route('member_content_info',$item->id)}}">编辑</a>',
                        close: false
                    },{
                        text: '<a href="{{route('api_content_delete',$item->id)}}" data-title="确定要删除吗?" data-msg="删除后无法恢复" class="ajax-get confirm">删除</a>',
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

            $('#comment-sb-btn').click(function () {
                $(this).closest('form').submit();
            })
        });
    </script>
@endsection