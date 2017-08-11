<div class="album active">
    <div class="ul">
        @foreach($album_list as $album)
            <div class="recommend-item collections">
                <a href="{{route('works_list_album',$album->id)}}">
                    <div class="front-cover" style="background-color: rgb({{mt_rand(0,255)}}, {{mt_rand(0,255)}}, {{mt_rand(0,255)}}); background-image:url({{$album->pic}})"></div>
                    <div class="front-name">
                        <h4>{{$album->name}}</h4>
                        <p>{{$album->count}}件作品</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>