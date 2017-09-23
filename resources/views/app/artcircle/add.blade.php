@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/work.css') }}">
@endsection
@section('title', '作品信息')
@section('body-style', 'site-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <header class="bar bar-nav">
                <a href="/" class="button button-link button-nav pull-left back"></a>
                <a href="javascript:;" class="btn btn-submit btn-publish" id="btn-submit">发表</a>
            </header>
            <div class="content native-scroll">

                <form action="{{route('save_art_circle')}}" id="work-form" class="form ajax-form" novalidate="novalidate" before_submit="before_submit">

                    <div class="info-box">
                        <div class="info-box-warp">
                            <div class="list-block">
                                <ul class="f8 data-ul">
                                    <li>
                                        <div class="item-content-uoder " style="margin-top: 0;">
                                            <textarea class="under-textarea" autocomplete="off" name="art_circle_desc" maxlength="65535" placeholder="此刻的想法..."></textarea>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <ul id="publish-img-box" class="publish-img-box clearfix pics">
                        <li id="upload-btn-wrap" class="publish-img-list fl uploadLi">
                            <input name="file" id="userfile" class="fileupload upload" accept="image/*" multiple="multiple" type="file">
                        </li>
                    </ul>
                    <div class="info-box">
                        <div class="info-box-warp">
                            <div class="info-box-content">
                                <div class="list-block">
                                    <ul class="f8 data-ul">
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner">
                                                    <div class="item-title label">作品标签</div>
                                                    <div class="item-input"></div>
                                                </div>
                                            </div>
                                            <div class="item-content-under">
                                                <div class="item-inner">
                                                    <input class="under-input1" type="text" value="" name="art_circle_tags" placeholder="每个标签最多6个汉字，用空格分隔…"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>

        function before_submit() {
            var flag = true;
            $('.publish-img-list img').each(function () {
                flag = false;
            });
            if(flag){
                $.error('请上传图片!');
                return false;
            }
        }
        // jQuery zepto vue angular 等库皆有 progress 的实现 以jQuery为例：
        $(function(){
            $('#btn-submit').click(function(){
                 $('#work-form').submit();
            });

            var $key = $('#key');  // file name    eg: the file is image.jpg,but $key='a.jpg', you will upload the file named 'a.jpg'
            var $userfile = $('#userfile');  // the file you selected

            $.pic_upload('#userfile',function(res) {
                console.log("成功：" + JSON.stringify(res));
                var _html = '<li class="publish-img-list fl li">'+
                                '<img src="'+ cat.cdn_domain+res.key + '"/>'+
                                '<a href="javascript:;" class="del-btn btn-del"></a>' +
                                '<input type="hidden" name="art_circle_pics[]" value="'+cat.cdn_domain+res.key+'" >'
                            '</li>';

                $('#upload-btn-wrap').before(_html);
            });

            $(document).on('click','.del-btn',function(){
                $(this).closest('li').remove();
            });
        });
    </script>

@endsection