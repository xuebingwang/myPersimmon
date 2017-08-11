@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/index.css') }}">
@endsection

@section('title', '猫眼艺术')
@section('body-style', 'feed-body notlogin-body')
@section('content')
    <div class="page-group">
        <div class="page special-nav page-current">

            @include('app.common.nav')

            <header class="bar bar-nav top-bar    nav-white">
                <a class="button button-link button-nav pull-left search-btn" href="/search"></a>
                <h1 class="title">
                    <span class="logo-span"></span>
                </h1>
                <a class="button button-link button-nav pull-right release-btn" href="/write"></a>
            </header>
            <div class="content native-scroll feed-content infinite-scroll pull-to-refresh-content" data-ptr-distance="40" data-distance="500">
                <div class="pull-to-refresh-layer">
                    <div class="preloader"></div>
                    <div class="pull-to-refresh-arrow"></div>
                </div>
                <section class="surface cover">
                    <a href="{{route('work_info',$front_cover->work_id)}}" class="fill-text-btn">
                        <div class="inner"></div>
                    </a>
                    <div class="image-fill promo-fill" style="background-image:url({{$front_cover->work_pic}});"></div>
                    <header class="bar bar-nav">
                        <a class="button button-link button-nav pull-left search-btn" href="/search"></a>
                        <h1 class="title">
                            <span class="logo-span"></span>
                        </h1>
                        <a class="button button-link button-nav pull-right release-btn" href="{{route('member_work_add')}}"></a>
                    </header>
                    <div class="fill-text">
                        <a href="http://m.artand.cn/artid/477946" class="fill-text-btn">
                            <h3>今日封面</h3>
                            <p>© {{$front_cover->author}}
                                <span>/</span>{{$front_cover->work_name}}</p></a>
                    </div>
                </section>
                <div class="content-block">
                    <div class="list-block">
                        <div class="feed-list-container">
                            <ul class="list-container" id="list">
                                @foreach($works as $work)
                                <li class="item-content">
                                    <div class="item-style-1 clearfix item-style-box">
                                        <div class="head-box-name clearfix">
                                            <div class="artistPhoto-warp-l clearfix">
                                                <div class="artistPhoto fl">
                                                    <a href="{{empty($work->member_domain)? route('php',$work->mid) : ('/'.$work->member_domain)}}">
                                                        <img src="{{$work->member_avatar}}" class="photo" style="opacity: 1;">
                                                    </a>
                                                </div>
                                                <div class="artistText fl">
                                                    <p>
                                                        <a href="{{empty($work->member_domain)? route('php',$work->mid) : ('/'.$work->member_domain)}}">
                                                            <span class="t-name">{{$work->author}}</span></a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="artistPhoto-warp-r clearfix">
                                                <p class="d-area clearfix">
                                                    <span class="time-span">{{time_tran($work->member_last_login)}}</span>
                                                    <span class="area-left city" data-city_id="{{$work->member_city_id}}">
                                                    <i class="icon site-icon"></i>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="list-item-works clearfix">
                                            <a href="{{route('work_info',$work->id)}}">
                                                <div class="p-relative">
                                                    <div class="images-works" style="background-color: rgb(132, 113, 106); background-image: url({{$work->pic}}); opacity: 1;"></div>
                                                    <div class="d-price">
                                                        <div class="info-t">
                                                            <h4>{{$work->name}}</h4>
                                                            <h5>{{$work->quality}}
                                                                <i>/</i>{{$work->size_w}}×{{$work->size_h}}cm
                                                                <i>/</i>{{$work->times}}</h5>
                                                        </div>
                                                        @if($work->is_sale == \App\CatEyeArt\Common::YES)
                                                            <p class="art-price">¥</p></div>
                                                        @endif
                                                </div>
                                            </a>
                                        </div>
                                        <div class="thumbs-box-warp">
                                            <?php $work->likes = $work->getLikes(3,1); ?>
                                            <div class="zan-heart-warp">
                                                <a href="javascript:;" class="btn_like zan-heart">
                                                    <span class="heart"></span>
                                                    <span class="frequency num">{{$work->likes->total()}}次赞</span>
                                                </a>
                                                <div class="head-portrait liked">
                                                    @foreach($work->likes as $like)
                                                    <a class="btn head-btn" href="{{route('php',$like->mid)}}">
                                                        <img src="{{$like->avatar}}" class="photo layz">
                                                    </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="back-top-top gotop"></div>
        </div>
    </div>
@endsection

@section('footer')
@endsection

@section('scripts')
@endsection
