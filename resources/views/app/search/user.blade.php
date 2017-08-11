
@foreach($results as $item)
    <li class="user-item user-li">
        <div class="artistDetail article-author clearfix">
            <div class="clearfix">
                <div class="artistDetailBox fl url">
                    <div class="artistPhoto fl">
                        <a href="@if(empty($item->domain)){{route('php',$item->mid)}}@else {{$item->domain}}@endif">
                            <img src="{{$item->avatar}}" class="photo">
                        </a>
                        @if($item->is_verfiy == \App\CatEyeArt\Common::YES)
                        <span class="approve approve-yellow"></span>
                        @endif
                    </div>
                    <div class="artistDetails fl">
                        <div class="clearfix">
                            <a class="name fl" href="@if(empty($item->domain)){{route('php',$item->mid)}}@else {{$item->domain}}@endif">{{$item->name}}</a></div>
                        <p class="d-area clearfix">
                            <span class="area-left city" data-city_id="{{$item->city_id}}">
                                <i class="icon site-icon"></i>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="comment-detail-right fr">
                    <a href="{{route('api_member_star',$item->id)}}" data-url="{{route('api_member_star',$item->id)}}" class="attention fr btn_follow @if(empty($item->follow_id)) ajax-get @else follow_btn @endif" submit_success="star_success">关注</a></div>
            </div>
        </div>
    </li>
@endforeach