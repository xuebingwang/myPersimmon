@foreach($list as $item)
    {{--@if(empty($item->desc))--}}
        {{--<li class="pic-list">--}}
            {{--<div class="sjblok">--}}
                {{--<h1><a href="{{route('content_info',$item->id)}}">{{$item->title}}</a></h1>--}}
                {{--<div class="sjblok-imgs clearfix">--}}
                    {{--@foreach($item->pics as $key=>$pic)--}}
                        {{--@if($key > 2) @break @endif--}}
                    {{--<a href="{{route('content_info',$item->id)}}"><img src="{{image_view2($pic->url,100,100)}}" alt=""></a>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--<p>{{$item->member_name}} 评论0 {{$item->created_at}}</p>--}}
            {{--</div>--}}
        {{--</li>--}}
    {{--@else--}}
        <li class="content-list">
            <a class="clearfix" href="http://mall.cateyeart.com/app/index.php?i={{$item->eid}}&c=entry&do=detail&m=tech_superarticle&id={{$item->id}}">
                <div class="sj-text">
                    <h1>{{$item->title}}</h1>
                    <div class="sj-t-md">
                        {{mb_substr(strip_tags($item->content),0,80)}}
                    </div>
                    <p>{{$member_list[$item->mid]}} 评论0 {{date('Y-m-d',$item->createtime)}}</p>
                </div>
                <img src="{{$item->thumb}}" alt="">
            </a>
        </li>
    {{--@endif--}}
@endforeach