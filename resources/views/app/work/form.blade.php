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
                <h1 class="title">作品信息</h1>
                <a href="javascript:;" class="btn btn-submit btn-publish" id="btn-submit">发布</a>
            </header>
            <div class="content native-scroll">

                <ul id="publish-img-box" class="publish-img-box clearfix pics">
                    @foreach($work->pics as $pic)
                    <li class="publish-img-list fl li">
                        <img src="{{$pic->url}}"/>
                        <a href="javascript:;" class="del-btn btn-del"></a>
                        <div class="map-box lead">
                            <span class="bj"></span>
                            </div>
                    </li>
                    @endforeach
                    <li id="upload-btn-wrap" class="publish-img-list fl uploadLi">
                        <input name="file" id="userfile" class="fileupload upload" accept="image/*" multiple="multiple" type="file">
                    </li>
                </ul>

                <form action="{{route('api_work_save')}}" id="work-form" class="form ajax-form" novalidate="novalidate" before_submit="before_submit">
                    <input name="work_id" type="hidden" value="{{$work->id}}">
                    <div class="info-box">
                        <div class="info-box-warp">
                            <div class="info-box-content">
                                <div class="list-block">
                                    <ul class="f8 data-ul">
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner ">
                                                    <div class="item-title label">作品名称（必填）</div>
                                                    <div class="item-input">
                                                        <input type="text" placeholder="请输入" name="work_name" value="{{$work->name}}" maxlength="50"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="item-content ">
                                                <div class="item-inner item-inner-right">
                                                    <div class="item-title label label-45">作品类别（必选）</div>
                                                    <div class="item-input">
                                                        <select class="type" name="work_category_id" autocomplete="off">
                                                            <option class="display-none" value="">请选择</option>
                                                            @foreach ($categorys as $cate)
                                                                <option value="{{$cate['id']}}" @if ($work->category_id == $cate['id']) selected @endif>
                                                                    {{$cate['category_name']}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner">
                                                    <div class="item-title label">尺寸（必填）</div>
                                                    <div class="item-input"></div>
                                                </div>
                                            </div>
                                            <div class="item-content-under">
                                                <ul>
                                                    <li>
                                                        <div class="item-content">
                                                            <div class="item-inner ">
                                                                <div class="item-title label">高</div>
                                                                <div class="item-input">
                                                                    <input class="under-input" type="number" maxlength="5" autocomplete="off" placeholder="请输入" value="{{$work->size_h}}" name="size_h">
                                                                    <span class="cm_span">cm</span></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="item-content">
                                                            <div class="item-inner ">
                                                                <div class="item-title label">宽</div>
                                                                <div class="item-input">
                                                                    <input class="under-input" type="number" maxlength="5" autocomplete="off" placeholder="请输入" value="{{$work->size_w}}" name="size_w">
                                                                    <span class="cm_span">cm</span></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="info-box-content">
                                <div class="list-block">
                                    <ul class="f8 data-ul">
                                        <li>
                                            <div class="item-content ">
                                                <div class="item-inner item-inner-right">
                                                    <div class="item-title label label-45">创作年份</div>
                                                    <div class="item-input">
                                                        <select class="select" autocomplete="off" name="times">
                                                            @for($year = date('Y'); $year > 1917; $year--)
                                                            <option value="{{$year}}" @if ($work->times == $year) selected @endif>
                                                                {{$year}}
                                                            </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner ">
                                                    <div class="item-title label">材质</div>
                                                    <div class="item-input">
                                                        <input maxlength="20" name="quality" value="{{$work->quality}}" type="text" placeholder="请输入"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="item-content ">
                                                <div class="item-inner item-inner-right">
                                                    <div class="item-title label label-45">作品集</div>
                                                    <div class="item-input">
                                                        <select class="album" name="album_id">
                                                            @foreach($albums as $album)
                                                            <option value="{{$album['id']}}" @if($work->album_id == $album['id']) selected @endif>{{$album['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-content "><a href="">添加作品集</a></div>
                                        </li>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner">
                                                    <div class="item-title label">创作手记</div>
                                                    <div class="item-input"></div>
                                                </div>
                                            </div>
                                            <div class="item-content-uoder ">
                                                <textarea class="under-textarea" autocomplete="off" name="work_desc" maxlength="65535" placeholder="请输入你的创作手记...">{{$work->desc}}</textarea></div>
                                        </li>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner">
                                                    <div class="item-title label">作品标签</div>
                                                    <div class="item-input"></div>
                                                </div>
                                            </div>
                                            <div class="item-content-under">
                                                <div class="item-inner">
                                                    <input class="under-input1" type="text" value="{{$work->tags}}" name="work_tags" placeholder="每个标签最多6个汉字，用空格分隔…"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="pic_hidden_wrap"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>

        function before_submit() {
            var _html = '';
            $('.publish-img-list img').each(function () {
                _html += '<input type="hidden" name="work_pics[]" value="'+this.src+'" >';
            });
            if(_html == ''){
                $.error('请上传图片!');
                return false;
            }
            $('#pic_hidden_wrap').html(_html);
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
                                '<div class="map-box lead">' +
                                    '<span class="bj"></span>' +
                                '</div>' +
                            '</li>';
                $('#upload-btn-wrap').before(_html);
            });

            $(document).on('click','.del-btn',function(){
                $(this).closest('li').remove();
            });
            $(document).on('click','.map-box',function(){
                $(this).closest('li').prependTo($('#publish-img-box'));
            });
        });
    </script>
    {{--<script type="text/javascript" src="http://cdn.staticfile.org/plupload/2.3.1/moxie.min.js"></script>--}}
    {{--<script type="text/javascript" src="http://cdn.staticfile.org/plupload/2.3.1/plupload.dev.js"></script>--}}
    {{--<script type="text/javascript" src="http://cdn.staticfile.org/qiniu-js-sdk/1.0.14-beta/qiniu.js"></script>--}}

@endsection