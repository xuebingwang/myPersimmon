
<div class="shejibox">
    <div class="sj-lists">
        @if($list->isEmpty())
            @if($list->isEmpty())
                <div class="font5 text-center">
                    此用户还没有发表过文章!
                </div>
            @endif
        @else
        <ul>
            @include('app.content.list_ajax')
        </ul>
        @endif
    </div>
</div>
