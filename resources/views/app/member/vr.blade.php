<ul id="hot-works">
    @foreach($list as $item)
        <li>
            <div class="hot-opus">
                <a href="{{$vr_url}}tour/{{$item->view_uuid}}">
                    <img src="{{$item->thumb_path}}" height="180" alt="">
                    <span class="gplay"></span>
                </a>
                <span class="nmb-txt">免费展览</span>
            </div>
            <div class="hot-author clearfix">
                <div class="hot-author-txt">
                    <div class="clearfix hotnbox">
                        <div class="hot-author-name">{{$item->name}}</div>
                    </div>
                    <a class="hot-zan" href="javascript:">
                        <span class="icon icon-like"></span>
                        {{$item->browsing_num}}
                    </a>
                </div>
            </div>
        </li>
    @endforeach
</ul>