
@foreach($results as $item)
    <li class="works-li">
        <div class="list-item">
            <div class="p">
                <a class="p-pic lazy" style="background-color: rgb(105, 97, 98); background-image: url({{$item->pic}});" href="{{route('work_info',$item->id)}}"></a>
                {{--<p class="d-price">--}}
                    {{--<em class="h">--}}
                        {{--<span class="font-num">12000.00</span>--}}
                    {{--</em>--}}
                {{--</p>--}}
            </div>
            <div class="d">
                <a href="{{route('work_info',$item->id)}}">
                    <h3 class="d-title">
                        <?=str_replace($keyword,'<em>'.$keyword.'</em>',$item->name)?>
                    </h3>
                </a>
                <div class="d-main">
                    <p class="d-name">
                        <a href="@if(empty($item->domain)){{route('php',$item->mid)}}@else /{{$item->domain}} @endif">{{$item->author}}</a></p>
                    <p class="d-area clearfix">
                        <span class="area-left city" data-city_id="{{$item->city_id}}">
                            <i class="icon site-icon"></i>
                        </span>
                        <span class="area-right">{{time_tran($item->last_login)}}</span>
                    </p>
                </div>
            </div>
        </div>
    </li>
@endforeach