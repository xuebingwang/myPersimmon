
@foreach($comments as $comment)
    <li class="comment-record clearfix">
        <div class="reward-photo fl">
            <a href="@if(empty($comment->domain)){{route('php',$comment->mid)}}@else {{$comment->domain}}@endif">
                <img src="{{image_view2($comment->avatar,60,60)}}" class="photo" style="">
            </a>
            @if($comment->is_verfiy == \App\CatEyeArt\Common::YES)
                <span class="approve approve-yellow"></span>
            @endif
        </div>
        <div class="comment-detail">
            <div class="comment-detail-top clearfix">
                <div class="comment-detail-left fl">
                    <div class="top clearfix">
                        <a class="name fl" href="@if(empty($comment->domain)){{route('php',$comment->mid)}}@else {{$comment->domain}}@endif">{{$comment->name}}</a></div>
                    <div class="bottom">
                        <span>{{time_tran($comment->created_at)}}</span>
                        <span class="city" data-city_id="{{$comment->city_id}}">
                            <i class="icon site-icon"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="comment-detail-content">
                <p><?=ubb_replace($comment->content)?></p>
            </div>
        </div>
    </li>
@endforeach