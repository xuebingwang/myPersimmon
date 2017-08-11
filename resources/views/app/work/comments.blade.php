@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/work_info.css') }}">
@endsection
@section('title', '评论列表')
@section('body-style', 'list-box-warp')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <header class="bar bar-nav bar-nav-top">
                <a class="button button-link button-nav pull-left back" href="{{route('work_info',$work_id)}}">
                    <span class="return-icon"></span>
                </a>
                <h1 class="title">评论列表</h1>
            </header>
            <nav class="bar bar-tab chat-sendmsg-box">
                <footer class="chatfooter" id="comment">
                    <form action="{{route('api_work_comment')}}" class="ajax-form comment" submit_success="add_comment_success">
                        <div class="input-holder">
                            {{--<div id="featureBtns" class="feature-holder">--}}
                            {{--<a class="feature-btn btn-face" title="表情">--}}
                            {{--<span class="icon-emoji"></span>--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            <div class="text-holder focus">
                                <input type="hidden" name="work_id" value="{{$work_id}}">
                                <input id="comment-pid" type="hidden" name="pid" value="">
                                <textarea id="comment-content" class="textarea message" placeholder="随便说点什么~" name="comment"></textarea>
                                <button type="submit" class="btnSend btn-submit">发送</button>
                            </div>
                        </div>
                    </form>
                </footer>
            </nav>
            <div class="content native-scroll infinite-scroll" data-distance="200">
                <div class="comment-list-warp">
                    <div class="clearfix">
                        <ul class="comment-list clearfix" id="comment_list">
                            @include('app.work.comments_ajax')
                        </ul>
                    </div>
                </div>
                <div class="infinite-scroll-preloader">
                    <div class="preloader"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('app.common.comment')
    <script>
        var isLoad = false, url = '{{$comments->nextPageUrl()}}';
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

                        $('#comment_list').append(resp.data.html);
                        XBW.linkage.cityId2String($('#comment_list'));
                    }
                    if(resp.url){
                        url = resp.url;
                    }else{
                        $('.infinite-scroll-preloader').remove();
                        url = null;
                    }
                },'json');
        });
        XBW.cityId2String($('#comment_list'));
    </script>
@endsection