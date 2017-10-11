@extends('app.layouts.cateyeartv2')
@section('style')
    <style>
        .qqFace{margin-top:4px;background:#fff;padding:2px;border:1px #dfe6f6 solid; top: -3.8rem !important; left: 0 !important;}
        .qqFace table{ width: 100%;}
        .qqFace table td{padding:0px;}
        .qqFace table td img{cursor:pointer;border:1px #fff solid;}
        .qqFace table td img:hover{border:1px #0066cc solid;}
    </style>
@endsection

@section('title', '与'.$to_member->name.'的聊天')
@section('content')

    <!-- header start -->
    <div class="sy-header">
        <div class="sy-head-top clearfix">
            <a class="homep-a homep-return back" href="javascript:;">
                <span class="icon icon-back"></span>
            </a>
            <h1>Cateyeart</h1>
        </div>
    </div>
    <div style="height: 1.45rem"></div>

    <div class="tidings">
        <ul id="item-wrap">
            @foreach($list as $item)
                @if($item->from_mid == $from_member->id)
                    <li class="t-right clearfix">
                        <img class="thead" src="{{image_view2($from_member->avatar,60,60)}}" alt="">
                        <div class="t-text">
                            <?=ubb_replace($item->content)?>
                        </div>
                    </li>
                @else
                    <li class="t-left clearfix">
                        <img class="thead" src="{{image_view2($to_member->avatar,60,60)}}" alt="">
                        <div class="t-text">
                            <?=ubb_replace($item->content)?>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>


    <div class="xiaoxi-bot">
        <form action="{{route('api_message_save')}}" class="ajax-form" submit_success="add_content_success">
            <input name="to_mid" type="hidden" value="{{$to_member->id}}">
            <div class="plbq emotion" style="float: left; margin: .2rem 0 .1rem .2rem;"></div>
            <input id="msg-content" name="msg_content" class="xx-txt" type="text" placeholder="说点什么">
            <input class="xx-btn" type="submit" value="发言">
        </form>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script type="text/javascript" src="/js/qqface/jquery.qqFace.js"></script>
    <script>

        function add_content_success(form,resp) {
            console.info(resp)
            var _html = '<li class="t-right clearfix">\
                            <img class="thead" src="{{image_view2($from_member->avatar,60,60)}}" alt="">\
                            <div class="t-text">'+resp.data.content+'</div>\
                        </li>';
            $('#msg-content').val('');

            $('#item-wrap').append(_html);
        }
        
        $(function () {
            $('.emotion').qqFace({
                assign:'msg-content', //给输入框赋值
                path:'/js/qqface/arclist/'    //表情图片存放的路径
            });
        });
    </script>
@endsection
