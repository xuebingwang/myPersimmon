<!DOCTYPE html>
<html>
<head>
    <title>艺术圈子</title>
    <meta charset="UTF-8">

    <meta name="format-detection" content="telephone=no" />
    <meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/style.css') }}?2017062311">

    <style type="text/css">
        #list,#list li,.po-hd,.post {
            overflow: hidden
        }

        .po-cmt,.post .list-img:nth-child(1),.time {
            float: left
        }

        #list li,.cmt-wrap,.r,.time {
            clear: both
        }

        .btn,a {
            cursor: pointer
        }

        blockquote,body,code,dd,div,dl,dt,fieldset,form,h1,h2,h3,h4,h5,h6,input,legend,li,ol,p,pre,td,textarea,th,ul {
            margin: 0;
            padding: 0
        }

        table {
            border-collapse: collapse;
            border-spacing: 0
        }

        fieldset,img {
            border: 0
        }

        address,caption,cite,code,dfn,em,strong,th,var {
            font-style: normal;
            font-weight: 400
        }

        ol,ul {
            list-style: none none
        }

        caption,th {
            text-align: left
        }

        h1,h2,h3,h4,h5,h6 {
            font-size: 100%;
            font-weight: 400
        }

        q::after,q::before {
            content: ""
        }

        abbr,acronym {
            border: 0;
            font-variant: normal
        }

        sup {
            vertical-align: text-top
        }

        sub {
            vertical-align: text-bottom
        }

        input,select,textarea {
            font-family: inherit;
            font-size: inherit;
            font-weight: inherit
        }

        legend {
            color: #000
        }

        a {
            text-decoration: none
        }

        input {
            -webkit-appearance: none
        }

        * {
            -webkit-tap-highlight-color: transparent
        }

        html {
            font-family: Arial,sans-serif;
            font-size: 13px
        }
        body{
            background-color: #f8f8f8;
        }

        @media screen and (min-width:350px) {
            html {
                font-size: 15px
            }

            .cmt-wrap {
                font-size: 14px
            }

            .time {
                font-size: 13px
            }
        }

        header {
            position: relative
        }

        #avt,#user-name {
            position: absolute
        }

        #bg {
            width: 100%
        }

        #user-name {
            text-align: right;
            right: 114px;
            bottom: 15px;
            color: #fff;
            font-weight: 700;
            font-size: 15px;
            text-shadow: 0 1px .5px #000
        }

        #share a,.btn {
            font-size: 14px
        }

        .btn,b {
            font-weight: 400
        }

        #share a,#share p,.btn {
            text-align: center
        }

        #avt {
            width: 74px;
            height: 74px;
            right: 15px;
            bottom: -22px;
            padding: 1px;
        }

        #list li,.po-hd {
            position: relative
        }

        #list {
            padding: 30px 0 10px
        }

        #list li {
            line-height: 1.5;
            border-bottom: 1px solid #e2e2e2;
            margin-top: 15px;
            padding-bottom: 15px
        }

        #share a:nth-child(2),.ads,.po-avt {
            position: absolute
        }

        .ads {
            color: #999;
            right: 5px;
            top: 0
        }

        .ads img {
            width: 10px;
            padding-left: 8px
        }

        .ad-link {
            color: #3b5384
        }

        .post .ad-link img {
            width: 11px;
            padding: 0;
            display: inline-block
        }

        .po-avt-wrap {
            padding-left: 10px
        }

        .po-avt {
            width: 40px;
            height: 40px;
            top: 0;
            left: 10px
        }

        .r {
            border-bottom: 8px solid #eee;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            width: 1px;
            margin-top: 5px;
            margin-left: 10px
        }

        .po-cmt {
            padding-left: 60px;
            padding-right: 10px;
            width: 100%;
            box-sizing: border-box
        }

        .po-name {
            color: #576b95
        }

        .post {
            color: #252525;
            padding-bottom: 10px
        }

        .post img {
            padding: 10px 5px 0 0;
            display: block;
            max-height: 130px;
            max-width: 130px
        }

        #share a,.btn {
            display: inline-block
        }

        .post .list-img {
            width: 30%;
            max-height: 80px;
            max-width: 80px;
            padding-right: 5px;
            float: left;
            object-fit: cover
        }

        .post .list-img:last-child {
            padding-right: 0
        }

        .time {
            color: #b1b1b1
        }

        .c-icon {
            width: 20px;
            float: right
        }

        .cmt-wrap {
            width: 100%;
            background-color: #eee
        }

        .like {
            color: #576b95;
            padding: 5px 5px 3px 12px
        }

        .like img {
            width: 20px;
            padding-right: 5px
        }

        .cmt-list {
            padding: 5px 12px;
            color: #454545
        }

        .cmt-list p {
            padding-top: 3px
        }

        .cmt-list span {
            color: #3b5384
        }

        #share a {
            border-radius: 5px;
            background-color: #26337e;
            color: #fff;
            line-height: 2.5;
            width: 138px;
            margin: 0 10px
        }

        #share a:nth-child(1) {
            position: absolute;
            left: 50%;
            margin-left: -148px
        }

        #share a:nth-child(2) {
            right: 50%;
            margin-right: -148px
        }

        #share p {
            padding: 45px 0 10px;
            color: #999
        }

        .bar {
            background: #fff;
            height: 44px;
            position: absolute;
            right: 0;
            left: 0;
            z-index: 20;
        }
        .bar-nav .back {
            display: inline-block;
            width: 40px;
            height: 44px;
            background: url("/cateyeart/img/6.png") center no-repeat;
            background-size: 10px 19px;
            margin-left:-0.25rem;
        }
        .title {
            position: absolute;
            z-index: 1;
            display: block;
            width: 100%;
            padding: 0;
            top:0;
            font-size: 16px;
            font-weight: 500;
            line-height: 44px;
            color: #3d4145;
            text-align: center;
            white-space: nowrap;
        }
        .add_artcircle{
            float: right;
            display: inline-block;
            width: 34px;
            height: 28px;
            position: relative;
            z-index: 99;
        }
        .add_artcircle img{
            width: 25px;
            margin-top: 10px;
        }
    </style>

</head>
<body>
<div style="margin:0 auto;display:none;">
    <img class="data-avt" src="/cateyeart/img/artcircle/0.jpg">
</div>
<header>
    <div class="bar bar-nav">
        <a class="button button-link button-nav pull-left back" href="/"></a>
        <h1 class="title">艺术圈</h1>
        <a href="{{route('add_artcircle')}}" class="add_artcircle"><img src="/cateyeart/img/verify/camera.png"></a>
    </div>
    <img id="bg" src="/cateyeart/img/artcircle/bg.jpg">
    <p id="user-name" class="data-name">{{$member->name}}</p>
    <img id="avt" class="data-avt" src="{{$member->avatar}}">
</header>
<div id="main">
    <div id="list">
        <ul>
            <li>
                <div class="po-avt-wrap">
                    <img class="po-avt data-avt" src="http://img1.huapinhua.com/4fa9st6bpng.png">
                </div>
                <div class="po-cmt">
                    <div class="po-hd">
                        <p class="po-name"><span class="data-name">兵兵</span></p>
                        <div class="post">
                            <p>大家好～</p>
                            <p>
                                <img class="list-img data-avt" src="cateyeart/img/artcircle/0.jpg" style="height: 80px;">
                            </p>
                        </div>
                        <p class="time">刚刚</p><img class="c-icon" src="cateyeart/img/artcircle/c.png">
                    </div>
                    <div class="r"></div>
                    <div class="cmt-wrap">
                        <div class="like"><img src="cateyeart/img/artcircle/l.png">兵兵</div>

                    </div>
                </div>
            </li>
        </ul>
    </div>

</div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>

<script src="/cateyeart/js/light7.js?20170715"></script>
</body>
</html>