@extends('app.layouts.cateyeartv2')

@section('title', '艺术')

@section('content')

    @include('app.common.index_header')
    <!-- 艺术列表 -->
    <div class="art-lists clearfix">
        @foreach($works as $item)
        <a href="{{route('work_info',$item->id)}}"><img src="{{image_view2($item->pic,150,150)}}" alt=""></a>
        @endforeach
    </div>

    @include('app.common.nav')
@endsection