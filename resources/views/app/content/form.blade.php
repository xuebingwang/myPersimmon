
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>猫眼艺术</title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <!-- 强制让文档的宽度与设备的宽度保持1:1，并且文档最大的宽度比例是1.0，且不允许用户点击屏幕放大浏览 -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width, minimal-ui">
    <!-- iphone设备中的safari私有meta标签，它表示：允许全屏模式浏览 -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <style>
        html {
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", "宋体", Arial, Verdana, sans-serif;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            font-size: 60.5%;
        }
        body {
            font-size: 1.5rem;
        }
        html,
        body,
        div,
        p {
            margin: 0;
            padding: 0;
            border: 0;
            vertical-align: baseline;
            font-weight: normal;
        }
        a {
            background: transparent;
        }
        a:active,
        a:hover {
            outline: 0;
        }
        img {
            border: 0;
        }
        input,
        optgroup,
        textarea {
            color: inherit;
            font: inherit;
            margin: 0;
        }
        html input[type="button"],
        input[type="reset"],
        input[type="submit"] {
            -webkit-appearance: button;
            cursor: pointer;
        }
        html input[disabled] {
            cursor: default;
        }
        input::-moz-focus-inner {
            border: 0;
            padding: 0;
        }
        input {
            line-height: normal;
        }
        * {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
        body {
            background: #ededed;
            color: #666666;
            line-height: 20px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
        }
        body.white {
            background: #ffffff;
        }
        html.hairlines div,
        html.hairlines li,
        html.hairlines a,
        html.hairlines i,
        html.hairlines header {
            border-width: 0.5px !important;
        }
        html .g-image-upload-box .upload-btn {
            border: 1px dashed #e3e3e3 !important;
        }
        a {
            color: #3278ee;
            text-decoration: none;
        }
        input[type="text"],
        input[type="password"],
        input[type="search"],
        input[type="tel"],
        textarea {
            border: none;
            font-size: 1.6rem;
            line-height: 1.6rem;
            padding: 5px;
            color: #333333;
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", "宋体", Arial, Verdana, sans-serif;
            outline: none;
            -webkit-border-radius: none;
            -moz-border-radius: none;
            border-radius: none;
            width: 100%;
        }
        textarea {
            outline: none;
            border: none;
            resize: none;
            height: 90px;
            width: 100%;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            /* Firefox */
            -webkit-box-sizing: border-box;
            /* Safari */
        }
        input[type=text]:active,
        input[type=password]:active,
        textarea:active,
        input[type=text]:focus,
        input[type=password]:focus,
        textarea:focus {
            border: none;
            background: #ffffff;
            outline: none;
        }
        ::-webkit-input-placeholder {
            -webkit-text-fill-color: #bdbdbd;
        }
        ::-moz-placeholder {
            color: #dddddd;
        }
        input:-ms-input-placeholder {
            color: #dddddd;
        }
        textarea:-ms-input-placeholder {
            color: #dddddd;
        }

        .publish-article-title {
            padding: 15px;
            background: #fff;
        }
        .title-tips {
            font-weight: bold;
            margin-bottom: 3px;
        }
        .publish-article-content {
            padding: 15px;
            background: #fff;
            border-left:none;
            border-right: none;
        }
        .publish-article-content .article-content {
            height: auto;
        }
        .publish-article-content .footer-btn-wrap {
            text-align: center;
            padding-top: 10px;
        }
        .footer-btn-wrap .footer-btn{
            padding: .8rem 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #000;
            background: #ccc;
            font-size: 1.5rem;
            line-height: 1.5rem;
            display: inline-block;
        }
        ul{ padding-left: 0;}

        .publish-img-box li{ list-style: none;}
        .publish-img-box .publish-img-list {
            width:5.5rem;
            height:5.5rem;
            margin-right:2%;
            position:relative;
            border:0;
            display: inline-block;
        }
        .publish-img-box .uploadLi{
            background:#e5e5e5 url("/cateyeart/img/publish/add-img.png") center no-repeat;
            background-size:38px 38px;
        }
        .publish-img-box .publish-img-list img{
            width: 100%;
            height: 100%;
        }
        .publish-img-list a {
            width:21px;
            height:21px;
            background:url("/cateyeart/img/publish/close1.png?v=1487071089") no-repeat;
            background-size:21px 21px;
            display:inline-block;
            position:absolute;
            top:-7px;
            right:-7px;
            z-index:30
        }
        .upload {
            position:absolute;
            width:100%;
            height:100%;
            z-index:20;
            opacity:0;
            left:0
        }
        .tips{font-weight: normal;font-size: 1rem;}
        .Eleditor-controller ul li.Eleditor-uploadPic:before{
            background-position:0px -62px;
        }
    </style>

</head>
<body>
<div style="width:100%;margin: 0 auto;">
    <form id="content-form" action="{{route('api_content_save')}}">
        {{ csrf_field() }}
        <div class="publish-article-title">
            <div class="title-tips">标题</div>
            <input type="text" id="title" name="title" class="w100" placeholder="文章标题">
        </div>
        <div class="publish-article-title">
            <div class="title-tips">分类</div>
            <select name="category_id">
                @foreach ($categorys as $cate)
                    <option value="{{$cate['id']}}" @if ($content->category_id == $cate['id']) selected @endif>
                        {{$cate['category_name']}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="publish-article-title">
            <div class="title-tips">封面图<span class="tips">(建议正方形图片)</span></div>

            <ul id="publish-img-box" class="publish-img-box clearfix pics">
                <li id="upload-btn-wrap" class="publish-img-list fl uploadLi">
                    <input name="file"class="upload pic-upload" accept="image/*" multiple="multiple" type="file">
                    <span id="preview-img"></span>
                </li>
            </ul>
            {{--<input type="hidden" name="pic" id="pic" />--}}
        </div>

        <input name="desc" type="hidden" id="desc">
    </form>
    <div class="publish-article-content">
        <div class="title-tips">正文<span class="tips">(点击内容编辑)</span></div>
        <input type="hidden" id="target">
        <div class="article-content" id="content">
            <div id="contentEditor">
            </div>
        </div>
    </div>
    <div style="border-top: 1px solid #ccc"></div>
    <div class="publish-article-content">
        <div class="footer-btn-wrap">
            <a class="footer-btn" id="sb-btn" href="javascript:">保存</a>
            <a href="javascript:" class="footer-btn back">取消</a>
        </div>
    </div>
</div>

<script src="https://cdn.bootcss.com/jquery/2.0.1/jquery.min.js"></script>
<script>
    window.cat = {};
    cat.csrf_token = '{{csrf_token()}}';
    cat.cdn_domain = '{{cdn('')}}';
</script>
<script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}?12334"></script>
<!-- 插件核心 -->
<script src="/cateyeart/js/Eleditor.js?12"></script>
<script src="//cdn.jsdelivr.net/eruda/1.0.4/eruda.min.js"></script>
<script>
    $(function () {
        eruda.init();

        var Edr = new Eleditor({
            el: '#contentEditor',
            toolbars: [
                'insertText',
                'editText',
//                'insertImage',
                //自定义一个按钮
                {
                    id: 'uploadPic',
                    name: '插图片<input name="file" class="upload pic-upload editor" accept="image/*" multiple="multiple" type="file">',
                    handle: function(select, controll){//回调返回选择的dom对象和控制按钮对象
                        var _$ele = $(select);
                        Edr.select = _$ele;
                        return false;
                    }
                },
                {
                    id: 'rotateImage',
                    tag: 'IMG', //指定IMG标签操作，可不填
                    name: '反转图片',
                    handle: function(select, controll){
                        var _$ele = $(select),
                                _$controll = $(controll);
                        if( _$ele.attr('transform-rotate') != '180deg' ){
                            _$controll.html('还原图片');
                            _$ele.attr('transform-rotate', '180deg').css('transform', 'rotate(180deg)');
                        }else{
                            _$controll.html('反转图片');
                            _$ele.removeAttr('transform-rotate').css('transform', 'rotate(0)');
                        }
                    }
                },
                'deleteBefore',
                'deleteAfter',
                'deleteThis',
                'insertLink',
                'insertHr',
                'cancel',
            ]
        });

        $('#sb-btn').click(function(){

            $('#desc').val($.trim(Edr.getContent().replace('<p class="Eleditor-placeholder">点击此处编辑内容</p>','')));
            $('#content-form').submit();
        });

        $('#content-form').submit(function(){
            if($.trim($('#title').val()) == ''){
                alert('请填写文章标题!');
                return false;
            }
//            if($.trim($('#desc').val()) == ''){
//                alert('请填写内容!');
//                return false;
//            }
            $.post(this.action,$(this).serializeArray(),function(resp){

                if(resp.status == '0' && resp.url){
                    setTimeout(function(){
                        window.location = resp.url;
                    },500);
                }
                alert(resp.msg);

            },'json');
            return false;
        });

        $.pic_upload('.pic-upload',function(res,obj) {
            if(obj.hasClass('editor')){
                Edr.select.before('<img src="'+cat.cdn_domain+res.key+'" width="100%">');
                $('.Eleditor-controller').hide();
            }else{
                var _html = '<li class="publish-img-list fl li">'+
                        '<img src="'+ cat.cdn_domain+res.key + '"/>'+
                        '<a href="javascript:;" class="del-btn btn-del"></a>' +
                        '<input type="hidden" name="content_pics[]" value="'+cat.cdn_domain+res.key+'" >'
                '</li>';

                $('#upload-btn-wrap').before(_html);

//                $('#preview-img').html('<img src="'+cat.cdn_domain+res.key+'" width="100%">');

//                $('#pic').val(cat.cdn_domain+res.key);
            }
        });


        $(document).on('click','.del-btn',function(){
            $(this).closest('li').remove();
        });
    })

    //请记住下面常用方法---------------------------------------->
    //Edr.append( str ); 往编辑器追加内容
    //Edr.getContent(); 获取编辑器内容
    //Edr.getContentText(); 获取编辑器纯文本
    //Edr.destory(); 移除编辑器

</script>
</body>
</html>
