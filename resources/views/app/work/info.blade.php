@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/work_info.css') }}">
@endsection
@section('title', $work->name.'-'.$work->member_name.'的作品')
@section('body-style', 'detail-page no-bar-footer')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <div class="content art-detail native-scroll">
                <div class="margin-bottom10">
                    <div class="artBox">
                        @foreach($work->pics as $pic)
                        <a href="javascript:;" class="art-img-btn">
                            <img src="{{$pic->url}}" width="100%">
                        </a>
                        @endforeach
                    </div>
                    <div class="artDetailBox">
                        <div class="artDetailHeader clearfix">
                            <h1 class="artName fl">{{$work->name}}</h1>
                            <div class="artDetailData fr">
                                {{--<a href="javascript:;" class="btn art-btn-sns btn-share"></a>--}}
                                <a href="javascript:;" class="btn art-btn-more btn-mange"></a>
                            </div>
                        </div>
                        <div class="author-box clearfix">
                            <a href="{{route('php',$work->mid)}}">{{$work->member_name}}</a>
                            <span>
                            <i class="icon au1"></i>{{date('m月d日',strtotime($work->created_at))}}</span>
                            <span>
                            <i class="icon au2"></i>{{$work->visits}}次浏览</span>
                        </div>
                        <div class="artDetail">{{$work->category_name}}
                            <i>/</i>{{$work->quality}}
                            <i>/</i>{{$work->size_w}}×{{$work->size_h}}cm
                            <i>/</i>{{$work->times}}年</div>
                        @if($work->is_sale == \App\CatEyeArt\Common::NO)
                            <p class="art-price">非卖品</p>
                        @endif
                        <div class="zan-div-warp">
                            <div class="zan  unfold_on clearfix">
                                <div class="zan-heart-warp">
                                    <a href="{{route('api_work_like',$work->id)}}" class="zan-heart btn_like @if(in_array($me->id,$work->likes->keyBy('mid')->keys()->toArray())) on heartAnimation @else ajax-get @endif" submit_success="like_success">
                                        <span class="heart"></span>
                                    </a>
                                </div>
                                <div class="zan-head-warp like-box" style="display: block;">


                                    <span class="aw-warp">
                                        <i class="aw a-a"></i>
                                        <i class="aw a-b"></i>
                                    </span>
                                    <div class="zan-box liked-list">
                                        @foreach($work->likes as $like)
                                            <a href="{{route('php',$like->mid)}}" class="cls{{$like->mid}}">
                                                <img alt="" src="{{$like->avatar}}" class="photo" style="">
                                            </a>
                                        @endforeach
                                        @if(sizeof($work->likes) > 7)
                                            <a href="javascript:" class="zan-count num">
                                                {{count($work->likes)}}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="margin-bottom10">
                    @if(!empty($work->desc))
                    <div class="artNote">
                        <div class="artNoteTitle">
                            创作手记
                        </div>
                        <p class="desc1">{{$work->desc}}</p>
                    </div>
                    @endif

                    <div class="artistDetail clearfix">
                        <div class="artistDetailBox fl">
                            <div class="artistPhoto fl">
                                <a href="{{route('php',$work->mid)}}">
                                    <img class="photo" src="{{$work->avatar}}" style="">
                                </a>
                                @if($work->is_verfiy == \App\CatEyeArt\Common::YES)
                                <span class="approve approve-yellow"></span>
                                @endif
                            </div>
                            <div class="artistDetails fl">
                                <div class="clearfix">
                                    <a href="/t8bno2" class="name fl">{{$work->member_name}}</a></div>
                                <div class="artist-data">
                                    <a href="javascript:;">
                                        <span>{{$work_num}}</span>件作品</a>
                                    <a href="javascript:;">
                                        <span>{{$work->stars}}</span>位粉丝</a></div>
                            </div>
                        </div>

                        @if($me->id != $work->mid)
                        <a id="btn_follow" href="{{route('api_member_star',$work->mid)}}" class="attention fr btn_follow @if(empty($is_followed)) ajax-get @else follow_btn @endif" submit_success="star_success">关注</a>
                        @endif
                    </div>
                </div>
                {{--<div class="margin-bottom10">--}}
                    {{--<div class="reward">--}}
                        {{--<div class="reward-top">--}}
                            {{--<a class="btn reward-btn-b" href="/payment/index?artid=419600&amp;type=1">--}}
                                {{--<span class="icon icon-reward"></span>打赏</a>--}}
                            {{--<p class="reward-num">共收到--}}
                                {{--<i>0</i>次打赏</p>--}}
                        {{--</div>--}}
                        {{--<ul class="reward-list clearfix"></ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="margin-bottom10">
                    <div class="comment review-warp">
                        <div class="textarea-itme-content">
                            <footer class="chatfooter" id="comment">
                                <form action="{{route('api_work_comment')}}" class="ajax-form comment" submit_success="add_comment_success">
                                    <div class="input-holder">
                                        {{--<div id="featureBtns" class="feature-holder">--}}
                                            {{--<a class="feature-btn btn-face" title="表情">--}}
                                                {{--<span class="icon-emoji"></span>--}}
                                            {{--</a>--}}
                                        {{--</div>--}}
                                        <div class="text-holder focus">
                                            <input type="hidden" name="work_id" value="{{$work->id}}">
                                            <input id="comment-pid" type="hidden" name="pid" value="">
                                            <textarea id="comment-content" class="textarea message" placeholder="随便说点什么~" name="comment"></textarea>
                                            <button type="submit" class="btnSend btn-submit">发送</button>
                                        </div>
                                    </div>
                                </form>
                            </footer>
                        </div>
                        <div class="clearfix">
                            <ul class="comment-list clearfix" id="comment_list">
                                <?php
                                    $comments = $work->getComments();
                                ?>
                                @foreach($comments as $comment)
                                <li class="comment-record clearfix">
                                    <div class="reward-photo fl">
                                        <a href="@if(empty($comment->domain)){{route('php',$comment->mid)}}@else {{$comment->domain}}@endif">
                                            <img src="{{$comment->avatar}}" class="photo" style="">
                                        </a>
                                        @if($comment->is_verfiy == \App\CatEyeArt\Common::YES)
                                        <span class="approve approve-yellow"></span>
                                        @endif
                                    </div>
                                    <div class="comment-detail">
                                        <div class="comment-detail-top clearfix">
                                            <div class="comment-detail-left fl">
                                                <div class="top clearfix">
                                                    <a class="name fl" href="@if(empty($comment->domain)){{route('php',$comment->mid)}}@else {{$comment->domain}}@endif">{{$comment->name}}</a></div>
                                                <div class="bottom">
                                                    <span>{{time_tran($comment->created_at)}}</span>
                                                    <span class="city" data-city_id="{{$comment->city_id}}">
                                                        <i class="icon site-icon"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-detail-content">
                                            <p>{{$comment->content}}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @if($comments->total() > 5)
                        <div class="more"><a href="{{route('work_comment_list',$work->id)}}">查看更多</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('app.common.comment')
    <script>

        @if($me->id != $work->mid)
        function star_success(obj) {
            obj.addClass('follow_btn').removeClass('ajax-get');
        }
        function unstar_success() {
            $('#btn_follow').removeClass('follow_btn').addClass('ajax-get');
        }
        $(function () {
            $(document).on('click','.follow_btn',function(){
                var group = [{
                    text: '<a href="{{route('api_member_star',$work->mid)}}" class="ajax-get" submit_success="unstar_success">取消关注</a>',
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
            $('.liked-list').append('<a href="{{route('php',$me->id)}}" class="cls{{$me->id}}">"' +'"<img alt="" src="{{$me->avatar}}" class="photo" style=""></a>');
        }

        function unlike_success(obj) {
            $('.btn_like').removeClass('on heartAnimation').addClass('ajax-get');
            $('.liked-list .cls{{$me->id}}').remove();
        }
        @endif
        $(function () {
            $(document).on('click','.heartAnimation',function(){
                var group = [{
                    text: '<a href="{{route('api_work_like',$work->id)}}" class="ajax-get" submit_success="unlike_success">不喜欢了</a>',
                    color: 'danger',
                    close: false
                },
                    {
                        text: '取消'
                    }];
                var modal = $.actions([group]);
                return false;
            })

            @if($me->id == $work->mid)
                $('.btn-mange').click(function(){
                    var group = [{
                        text: '<a href="{{route('member_work_info',$work->id)}}">编辑</a>',
                        close: false
                    },{
                        text: '<a href="{{route('api_work_delete',$work->id)}}" data-title="确定要删除吗?" data-msg="删除后无法恢复" class="ajax-get confirm">删除</a>',
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

        });
    </script>
@endsection