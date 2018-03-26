@foreach($list as $item)
    <li>
        <div class="fd-user clearfix">
            <a href="{{route('php',$item->mid)}}">
                <img src="{{image_view2($item->avatar,100,100)}}" alt="">
            </a>
            <div class="fd-user-txt">
                <h1>
                    <a href="{{route('php',$item->mid)}}">
                    {{$item->member_name}}
                    </a>
                @if($member->id != $item->mid)
                    @if(!is_login())
                        <a style="float: right;position: relative;" href="{{route('login')}}" class="gzbtn">关注</a>
                    @elseif(!in_array($item->mid,$star_list))
                        <a style="float: right;position: relative;" href="{{route('api_member_star',$item->mid)}}" class="gzbtn ajax-get btn_follow{{$item->mid}}" submit_success="star_success">关注</a>
                    @else
                        <a style="float: right;position: relative;" href="{{route('api_member_star',$item->mid)}}" class="gzbtn follow_btn btn_follow{{$item->mid}}"  submit_success="unstar_success">关注</a>
                    @endif

                @endif
                </h1>
                <p>{{time_tran($item->created_at)}}</p>

            </div>
        </div>
        <div class="fd-imgs clearfix">
            @for($i=0;$i<9;$i++)
                <?php $field = 'img'.$i;?>
                @if(!empty($item->$field))
                    <a href="{{$item->$field}}" class="swipebox">
                        <img src="{{image_view2($item->$field,100,100)}}" alt="" data-src="{{$item->$field}}">
                    </a>
                @endif
            @endfor
        </div>
        <div class="fd-btns clearfix">
            <a class="fd1 ajax-get" href="{{route('art_circle_star',$item->id)}}" title="" submit_success="do_star_success"></a>
            {{--<a class="fd2" href="javascript:;" title=""></a>--}}
            {{--<a class="fd3" href="javascript:;" title=""></a>--}}
            <span>浏览{{$item->visits}}次</span>
        </div>
        <div class="fd-zan">
            <div class="fd-zan-lists clearfix">
                @foreach($item->getStars() as $star)
                <span class="mid{{$star->mid}}">{{$star->name}}</span>
                @endforeach
            </div>

        </div>
    </li>
@endforeach