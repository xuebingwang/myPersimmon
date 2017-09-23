<div class="footer clearfix">
    <?php
    $segment = Request::segment(1);

    ?>
    <a href="/" class="f1 @if($segment == '' || $segment == 'index') on @endif">
        <span></span>
        <p>首页</p>
    </a>
    <a href="{{route('art_circle')}}" class="f2 @if($segment == 'art_circle') on @endif">
        <span></span>
        <p>圈子</p>
    </a>
    <a href="http://mall.huapinhua.com/app/index.php?i=3&c=entry&m=ewei_shopv2&do=mobile" class="f3">
        <span></span>
        <p>商城</p>
    </a>
    <a href="{{route('member_index')}}" class="f4 @if($segment == 'member') on @endif">
        <i>3</i>
        <span></span>
        <p>我的</p>
    </a>
</div>
