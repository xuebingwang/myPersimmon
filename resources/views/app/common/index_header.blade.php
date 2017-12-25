<!-- header start -->
<?php
$segment1 = Request::segment(1);
$segment2 = Request::segment(2);
?>
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
    <div class="sy-menu clearfix">
        <a class="@if($segment1 == 'index' || ($segment1 =='' && $segment2 == '')) on @endif" href="/">热门</a>
        <a class="@if($segment1 == 'star' && $segment2 == 'works') on @endif" href="{{route('star_works')}}">关注</a>

        <a class="@if($segment1 == 'works') on @endif" href="{{route('work_list')}}">艺术</a>
        <a class="@if($segment2 == '60') on @endif" href="{{route('contents_list',3)}}">设计</a>
        <a class="@if($segment2 == '61') on @endif" href="{{route('contents_list',2)}}">创意</a>
        <a class="@if($segment2 == '62') on @endif" href="{{route('contents_list',4)}}">空间</a>
    </div>
</div>
<div style="height: 2.45rem"></div>