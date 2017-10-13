<div class="footer clearfix">
    <?php
    $segment = Request::segment(1);

    ?>
    <a href="/" class="f1 @if($segment == '' || $segment == 'index') on @endif">
        <span class="icon icon-home"></span>
        <span>首页</span>
    </a>
    <a href="{{route('art_circle_recommend')}}" class="f2 @if($segment == 'art_circle') on @endif">
        <span class="icon icon-process"></span>
        <span>圈子</span>
    </a>
    <a href="http://mall.cateyeart.com/app/index.php?i=3&c=entry&m=ewei_shopv2&do=mobile" class="f3">
        <span class="icon icon-shop"></span>
        <span>商城</span>
    </a>
    <a href="{{route('member_index')}}" class="f4 @if($segment == 'member') on @endif">
        <i>3</i>
        <span class="icon icon-person2"></span>
        <span>我的</span>
    </a>
</div>
