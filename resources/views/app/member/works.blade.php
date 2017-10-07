@foreach($works as $work)
    <div class="zy-one">
        <a href="{{route('work_info',$work->id)}}">
            <img src="{{image_view2($work->pic,390,235)}}" alt="">
            <h1>{{$work->name}}</h1>
            <p>{{show_work_params($work)}}</p>
        </a>
    </div>
@endforeach