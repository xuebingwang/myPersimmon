@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/member.css') }}?2017062311">
    <style>
        .documents-box ul
        li {
            padding:0.8rem 0.75rem
        }
        .documents-box ul li
        h4 {
            font-weight:400
        }
        .upload {
            position:absolute;
            width:100%;
            height:100%;
            z-index:20;
            opacity:0;
            left:0
        }
        .left-images
        span {
            width:100%;
            height:7.6rem;
            position:absolute;
            z-index:10;
            display:block;
            line-height:7.6rem;
            text-align:center;
            font-size:0.7rem;
            color:#9C9C9C
        }
        .right-examples
        img {
            max-width:6rem;
            max-height:3rem;
            min-height:3rem
        }
        .right-examples
        p {
            padding-top:10px;
            font-size:12px;
            color:#555
        }
        .bottom-text {
            color:#9C9C9C;
            padding:0.8rem 2rem;
            text-align:left;
            font-size:0.6rem
        }
        .uploaded
        img {
            max-width:100%;
            max-height:100%;
            background-position:center center;
            background-size:cover
        }
        @media (device-height:568px) and (-webkit-min-device-pixel-ratio:2) {
            .left-images
            span {
                width:100%;
                height:5rem;
                position:absolute;
                z-index:10;
                display:block;
                line-height:5rem;
                text-align:center;
                font-size:0.7rem;
                color:#9C9C9C
            }
            .right-examples
            img {
                min-height:3rem
            }
        }
        .site-li-content .item-content .item-input-a
        select {
            direction:inherit
        }
        .list-block .p-text-right
        span {
            padding-right:6px
        }
        .documents-box ul
        li {
            padding:1.2rem 0.75rem
        }
        .Upload-box-new {
            text-align:center;
            width:100%;
            padding:0.4rem 0 1rem 0;
            position:relative
        }
        .uploadWarp {
            width:100%;
            position:relative;
            height:7rem;
            margin-top:0.5rem
        }
        .documents-box ul li
        h4 {
        }.uploadShow {
             width:100%;
             height:100%;
             position:absolute;
             z-index:5;
             top:0;
             left:0;
             text-align:center
         }
        .showImage {
            width:6.5rem;
            height:6.5rem;
            display:inline-block;
            background:#DFDFDF url(/cateyeart/img/verify/id.png)  center 1.1rem no-repeat;
            background-size:105px 60px;
            position:relative
        }
        .showImage
        .camera {
            width:32px;
            height:32px;
            background:#fff url(/cateyeart/img/verify/camera.png) center no-repeat;
            background-size:17px 14px;
            position:absolute;
            right:0;
            bottom:0
        }
        .uploadShow.on .showImage
        .camera {
            display:block
        }
        .showImage
        img {
            width:100%;
            height:100%
        }
        .headImages
        .showImage {
            width:6.5rem;
            height:6.5rem;
            display:inline-block;
            background:#DFDFDF url(/cateyeart/img/verify/head.png) center 0.6rem no-repeat;
            background-size:73px 79px
        }
        .note-tip {
            font-size:0.6rem;
            color:;
            padding:0.5rem 0;
            text-align:center;
            color:#999
        }
        .note-tip
        p {
            padding-bottom:0.3rem
        }
        .showBtn {
            width:6.5rem;
            height:32px;
            line-height:32px;
            background:#000;
            display:block;
            position:absolute;
            bottom:0;
            color:#fff;
            font-weight:500
        }
        .private_card
        h3 {
            font-size:14px;
            line-height:24px;
            font-weight:normal
        }
        .private_box .img_Box
        img {
            width:100%
        }
        .private_box .text_Box
        p {
            line-height:22px
        }
        .sign_spread_out
        ul {
            height:260px;
            overflow-y:scroll
        }
        .sign_spread_out ul
        li {
            padding:10px
            5px;
            border-bottom:1px dotted #DFDFDF;
            cursor:pointer
        }
        .sign_spread_out ul
        .selected {
            background:#f5f5f5
        }
        .sign_spread_out ul
        .head {
            display:inline-block;
            width:32px;
            margin-right:25px;
            height:32px;
            text-align:left;
            position:relative;
            overflow:hidden;
            border-radius:32px;
            float:left
        }
        .sign_spread_out ul .head .btn
        img {
            width:100%;
            height:100%
        }
        .sign_spread_out ul
        h3 {
            text-align:left;
            font-size:14px;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
            display:inline-block;
            width:80%
        }
        .sign_spread_out ul h3
        a {
            color:#2c2b2a;
            display:inline-block;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
            float:left;
            max-width:10em
        }
        .letter_warp .phiz .phiz_btn_a
        input {
            height:32px;
            left:0;
            opacity:0;
            position:absolute;
            top:0;
            width:100%;
            cursor:pointer
        }
        .one-step-tip
        h3 {
            font-size:0.7rem;
            text-align:center;
            padding-bottom:0.5rem;
            padding-top:0.5rem
        }
        .one-step-tip
        p {
            font-size:0.7rem;
            line-height:24px;
            padding:0.3rem 0;
            text-align:center
        }
        .verify-pop-modal.verify-pop-modal01 .modal-inner .one-step-tip
        p {
            color:#fff
        }
        .verify-submit1 {
            width:100%;
            line-height:40px;
            font-size:14px;
            text-align:center;
            color:#fff;
            display:inline-block;
            font-weight:500;
            background:#000;
            height:40px;
            top:11px;
            position:relative;
            border:none;
        }

    </style>
@endsection
@section('title', '申请认证')
@section('body-style', 'verify-body data-v-body ')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <header class="bar bar-nav">
                <a href="/" class="button button-link button-nav pull-left back"></a>
                <h1 class="title">申请猫眼艺术认证艺术家</h1></header>
            <form id="apply-form" class="content native-scroll site-content site-li-content apply ajax-form" novalidate="novalidate" action="{{route('api_verify_apply')}}">
                <div class="list-block site-li-block">
                    <ul class="f8 data-ul">
                        <li>
                            <div class="item-content">
                                <div class="item-inner ">
                                    <div class="item-title label">真实姓名（必填）</div>
                                    <div class="item-input">
                                        <input type="text" name="real_name" value="{{$member_verify->real_name}}" placeholder="请输入"></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">身份证号（必填）</div>
                                    <div class="item-input">
                                        <input type="text" placeholder="请输入" value="{{$member_verify->paper_num}}" name="paper_num"></div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">毕业院校</div>
                                    <div class="item-input">
                                        <div class="item-input">
                                            <input placeholder="请输入毕业院校" value="{{$member_verify->school_name}}" name="school_name" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">就读时间</div>
                                    <div class="item-input"></div>
                                </div>
                            </div>
                            <div class="list-block">
                                <ul>
                                    <li>
                                        <div class="item-content">
                                            <div class="item-inner">
                                                <div class="item-title label">入学年份</div>
                                                <div class="item-input">
                                                    <input placeholder="请输入入学年份,如1994" value="{{$member_verify->in_school_year}}" name="in_school_year" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="item-content">
                                            <div class="item-inner">
                                                <div class="item-title label">毕业年份</div>
                                                <div class="item-input">
                                                    <input placeholder="请输入毕业年份,如1999" value="{{$member_verify->out_school_year}}" name="out_school_year" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="list-block site-li-block documents-box">
                    <ul class="f8 data-ul">
                        <li>
                            <div class="clearfix Upload-box-new">
                                <h4>上传身份证照片</h4>
                                <div class="uploadWarp">
                                    <input type="file" name="file" data-name="id_pic" class="upload" accept="image/*" multiple="multiple">
                                    <div class="uploadShow">
                                        <div class="showImage">
                                            @if(empty($member_verify->id_pic))
                                                <span class="showBtn">点击上传</span>
                                            @else
                                                <img src="{{$member_verify->id_pic}}">
                                                <input type="hidden" name="id_pic" value="{{$member_verify->id_pic}}">
                                                <div class="camera"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix Upload-box-new">
                                <h4>上传本人头像照片</h4>
                                <div class="uploadWarp headImages">
                                    <input type="file" name="file" data-name="head_pic" class="upload" accept="image/*" multiple="multiple">
                                    <div class="uploadShow">
                                        <div class="showImage">
                                            @if(empty($member_verify->head_pic))
                                                <span class="showBtn">点击上传</span>
                                            @else
                                                <img src="{{$member_verify->head_pic}}">
                                                <input type="hidden" name="head_pic" value="{{$member_verify->head_pic}}">
                                                <div class="camera"></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="note-tip">
                                <p>照片仅用于身份验证，不对外显示</p>
                                <p>证件上所有信息清晰可见，必须能看清证件号。</p>
                            </div>
                        </li>
                    </ul>
                    <p class="bottom-text"></p>
                </div>

            </form>
            <div class="bar bar-standard bar-footer verify-submit-box" style="height: 3.1rem !important;">
                <a id="submit-btn" class="verify-submit1 btn-info" href="javascript:">提交</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>
        $(function () {
            $.pic_upload('.upload',function(res,obj) {
                console.log("成功：" + JSON.stringify(res));
                var _html = '<img src="'+cat.cdn_domain+res.key+'">' +
                        '<input type="hidden" name="'+obj.data('name')+'" value="'+cat.cdn_domain+res.key+'">' +
                        '<div class="camera"></div>';
                obj.next().find('.showImage').html(_html);
            });

            $('#submit-btn').click(function(){
                $('#apply-form').submit();
            });
        })
    </script>
@endsection