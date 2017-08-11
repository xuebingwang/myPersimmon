<div class="album active">
    <div class="attention-warp attention-w-new">
        <a href="{{route('member_album_add')}}" class="btn_add">
            <span>+</span> 添加作品集
        </a>
    </div>
    <div class="ul">
        @foreach($album_list as $album)
            <div class="recommend-item collections">
                <a href="{{route('member_album_info',$album->id)}}">
                    <div class="front-name">
                        <h4>{{$album->name}}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>