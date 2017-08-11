@extends('app.layouts.cateyeart')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ mix('cateyeart/css/work.css') }}">
@endsection
@section('title', '作品集')
@section('body-style', 'site-body')

@section('content')
    <div class="page-group">
        <div class="page page-current">
            <form action="{{route('api_album_save')}}" id="work-form" class="form ajax-form">
                <input name="album_id" type="hidden" value="{{$album->id}}">
                <header class="bar bar-nav">
                    <a href="/" class="button button-link button-nav pull-left back"></a>
                    <h1 class="title">作品集信息</h1>
                    <button type="submit" class="btn btn-submit btn-publish">确定</button>
                </header>
                <div class="content native-scroll">

                    <div class="info-box">
                        <div class="info-box-warp">
                            <div class="info-box-content">
                                <div class="list-block">
                                    <ul class="f8 data-ul">
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner ">
                                                    <div class="item-title label">作品集名</div>
                                                    <div class="item-input">
                                                        <input type="text" placeholder="请输入" name="album_name" value="{{$album->name}}" maxlength="50"></div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="item-content">
                                                <div class="item-inner ">
                                                    <div class="item-title label">是否公开</div>
                                                    <div class="item-input">
                                                        <span class=" switch-btn">
                                                            <label class="label-switch">
                                                                <input autocomplete="off" type="checkbox" value="y" @if($album->is_public == \App\CatEyeArt\Common::YES) checked="checked" @endif name="is_public">
                                                                <div class="checkbox"></div>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
@endsection