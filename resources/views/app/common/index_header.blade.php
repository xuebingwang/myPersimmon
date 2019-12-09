<!-- header start -->
<?php
$segment1 = Request::segment(1);
$segment2 = Request::segment(2);
?>

@section('style_header')
<style>
    .swiper-container2 .swiper-slide{width: auto!important;}
    .topmenu{height: 35px;background-color: white;border-bottom: 1px solid #CCCCCC;padding: 0 10px;line-height: 35px;font-family: "微软雅黑"}
</style>
@endsection

<div class="sy-header">
    <div class="sy-head-top clearfix">
        <a class="sysearchbtn" href="{{route('search')}}">
            <span class="icon icon-search1"></span>
        </a>
        <h1>Cateyeart</h1>
        <a class="syadd" href="javascript:">
            <span class="icon icon-add"></span>
        </a>
    </div>

    <div class="topmenu">
        <div class="swiper-container2">
            <div class="swiper-wrapper">
                <a class="swiper-slide @if($segment1 == 'index' || ($segment1 =='' && $segment2 == '')) on @endif" href="/">推荐</a>
                <a class="swiper-slide @if($segment1 == 'star' && $segment2 == 'works') on @endif" href="{{route('star_works')}}">关注</a>

                <a class="swiper-slide @if($segment2 == 'dasai') on @endif" href="javascript:">艺展大赛</a>
                <a class="swiper-slide @if($segment2 == 'shaoer') on @endif" href="javascript:">少儿艺展</a>
                <a class="swiper-slide @if($segment2 == 'mingjia') on @endif" href="javascript:">名家艺展</a>

                {{--<a class="swiper-slide @if($segment2 == 'works') on @endif" href="{{route('work_list')}}">艺展</a>--}}
                <a class="swiper-slide @if($segment2 == '60') on @endif" href="{{route('contents_list',3)}}">设计</a>
                <a class="swiper-slide @if($segment2 == '62') on @endif" href="{{route('contents_list',4)}}">空间</a>
                <a class="swiper-slide @if($segment2 == '61') on @endif" href="{{route('contents_list',2)}}">艺说</a>
            </div>
        </div>
    </div>
</div>

<div style="height: 2.45rem"></div>

@section('scripts_header')
<script>
    $(function () {
        var swiper = new Swiper('.swiper-container2', {
            spaceBetween: 20,
            slidesPerView: 'auto',
            freeMode: true
        });
    })
</script>
@endsection
