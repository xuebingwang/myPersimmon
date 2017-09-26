<!-- header start -->
<?php
$segment = Request::segment(2);
?>
<div class="sy-header">
    <div class="sy-head-top clearfix">
        <a class="sysearchbtn" href="{{route('search')}}"></a>
        <h1>Cateyeart</h1>
        <a class="syadd" href="javascript:"></a>
    </div>
    <div class="sy-menu clearfix">
        <a class="@if($segment == '') on @endif" href="/">热门</a>
        <a href="###">关注</a>

        <a class="@if($segment == '60') on @endif" href="{{route('contents_list',60)}}">艺术</a>
        <a class="@if($segment == '61') on @endif" href="{{route('contents_list',61)}}">设计</a>
        <a class="@if($segment == '62') on @endif" href="{{route('contents_list',62)}}">创意</a>
        <a class="@if($segment == '63') on @endif" href="{{route('contents_list',63)}}">空间</a>
    </div>
</div>
<div style="height: 2.45rem"></div>