@extends('app.layouts.cateyeart')
@section('title', '页面不存在')
@section('body-style', 'empty-warp')

@section('style')
    <style>

        .empty-box {
        }.promo-fill {
             background-color:#fff;
             background-position:center center;
             background-size:cover;
             position:absolute;
             left:0;
             top:0;
             right:0;
             bottom:0;
             z-index:10;
             background-attachment:scroll
         }
        .empty-box
        .inner {
            position:absolute;
            left:0;
            z-index:30;
            width:100%;
            height:100%;
            bottom:0;
            z-index:20;
            background:rgba(0,0,0,0.7)
        }
        .text-box {
            width:100%;
            position:absolute;
            text-align:center;
            top:9rem;
            margin:0;
            padding:0;
            left:0;
            z-index:40;
            color:#CCC;
            font-size:0.7rem
        }
        .text-box
        .h2 {
            display:inline-block;
            width:110px;
            height:32px
        }
        .text-box
        .h3 {
            padding-top:0.8rem
        }
        .Text1
        .h2 {
            background:url(/cateyeart/img/common/404t.png) no-repeat;
            background-size:110px 32px
        }
        .Text2
        .h2 {
            background:url(/cateyeart/img/common/articlet.png) no-repeat;
            background-size:167px 32px;
            width:167px
        }
        .Text3
        .h2 {
            background:url(/cateyeart/img/common/namet.png) no-repeat;
            background-size:167px 32px;
            width:167px
        }
        .empty-box .btn-box {
            width:100%;
            position:absolute;
            text-align:center;
            bottom:5rem;
            margin:0;
            padding:0;
            left:0;
            z-index:40
        }
        .empty-box .btn-box
        .btn {
            width:6rem;
            line-height:34px;
            background:#57AD68;
            border-radius:2px;
            font-size:0.7rem;
            color:#fff;
            margin:0 auto;
            display:block;
            text-align:center;
            margin-bottom:1rem
        }
        .empty-box .btn-box .btn:nth-child(2) {
            background:#B1B4BB
        }
    </style>
@endsection

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <div class="content native-scroll">
                <div class="content-block">
                    <div class="empty-box ">
                        <div class="inner"></div>
                        <div class="text-box {{$class}}">
                            <div class="h2"></div>
                            <div class="h3">{{$msg}}</div></div>
                        <div class="btn-box">
                            <a href="javascript:history.back();" class="btn back">返回</a>
                            <a href="/" class="btn">去首页</a></div>
                        <div class="promo-fill" style=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection