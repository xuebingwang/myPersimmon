@extends('app.layouts.cateyeartv2')


@section('title', '艺展')
@section('content')

    @include('app.common.index_header')

    <div class="shejibox">
        <div class="hot-pro-lists">
            @if(sizeof($list) == 0)
                <div style="height: 2.45rem"></div>
                <div class="font5 text-center">
                    当前栏目下暂时没有内容!
                </div>
            @else
            <ul id="hot-works">
                @include('app.vr.pictures_ajax')
            </ul>
            @endif
        </div>
    </div>

    @include('app.common.nav')
@endsection