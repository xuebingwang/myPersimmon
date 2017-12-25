@extends('app.layouts.cateyeartv2')


@section('title', $category->name)
@section('content')


    @include('app.common.index_header')

    <div class="shejibox">
        <div class="sj-lists">
            @if($list->isEmpty())
                @if($list->isEmpty())
                    <div class="font5 text-center">
                        当前栏目下暂时没有内容!
                    </div>
                @endif
            @else
            <ul>
                @include('app.content.list_ajax')
            </ul>
            @endif
        </div>
    </div>

    @include('app.common.nav')
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
@endsection
