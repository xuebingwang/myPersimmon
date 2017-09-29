@extends('app.layouts.cateyeartv2')

@section('title', '关注')

@section('content')

    @include('app.common.index_header')
    <!-- 艺术列表 -->
    <div class="hot-pro-lists">
        <ul id="hot-works">
            @foreach($works as $work)
                <li>
                    <div class="hot-opus">
                        <a href="{{route('work_info',$work->id)}}">
                            <img src="{{$work->pic}}" alt="">
                        </a>
                        <div class="hot-opus-mask">
                            <h1>{{$work->name}}</h1>
                            <p>{{show_work_params($work)}}</p>
                            @if($work->is_sale == \App\CatEyeArt\Common::YES)
                                <div class="opus-prize">￥</div>
                            @endif
                        </div>
                    </div>
                    <div class="hot-author clearfix">
                        <a href="{{empty($work->member_domain)? route('php',$work->mid) : ('/'.$work->member_domain)}}">
                            <img class="hothead" src="{{image_view2($work->member_avatar,80,80)}}" alt="">
                        </a>
                        <div class="hot-author-txt">
                            <div class="clearfix hotnbox">
                                <div class="hot-author-name">{{$work->author}}</div>
                            </div>
                            <div class="hot-author-bot clearfix">
                                <span>{{time_tran($work->member_last_login)}}来过</span>
                                <span class="hot-place city" data-city_id="{{$work->member_city_id}}"></span>
                            </div>

                            <?php $work->likes = $work->getLikes(3,1); ?>
                            <div class="hot-zan">{{$work->likes->total()}}</div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @include('app.common.nav')
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
@endsection