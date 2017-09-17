<div class="zy-two clearfix">
    @foreach($album_list as $key=>$album)
        <a href="{{route('member_album_info',$album->id)}}">
            <img src="{{$album->pic}}" alt="">
            <h1>{{$album->name}}</h1>
            <p>3件作品</p>
        </a>
        @if($key > 0 && $key % 2 == 1)
</div>
<div class="zy-two clearfix">
    @endif
    @endforeach
</div>