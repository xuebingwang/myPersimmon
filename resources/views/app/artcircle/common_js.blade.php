<script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
{{--<link rel="stylesheet prefetch" href="http://cdn.cdnjs.net/photoswipe/4.1.2/photoswipe.min.css">--}}
{{--<link rel="stylesheet prefetch" href="http://cdn.cdnjs.net/photoswipe/4.1.2/default-skin/default-skin.min.css">--}}
{{--<script src="http://cdn.cdnjs.net/photoswipe/4.1.2/photoswipe.min.js"></script>--}}
{{--<script src="http://cdn.cdnjs.net/photoswipe/4.1.2/photoswipe-ui-default.min.js"></script>--}}
{{--<script src="https://cdn.bootcss.com/light7/0.4.3/js/light7-swiper.min.js"></script>--}}
<script src="https://cdn.bootcss.com/jquery.swipebox/1.4.4/js/jquery.swipebox.js"></script>
<script src="/cateyeart/js/scroll.page.js"></script>
<script>

    function do_star_success(obj,resp) {
        if(resp.data.star){
            obj.parent().next().find('div').append('<span class="mid'+resp.data.mid+'">{{$member->name}}</span>');
        }else{
            obj.parent().next().find('.mid'+resp.data.mid).remove();
        }
    }
    $(function () {

        var is_loading = false;
        var surplus = $('#surplus');

        $('a.swipebox').swipebox();

//        var pic = $('.fd-imgs img').map(function(){
//            return $(this).data("src");
//        }).get();
//
//        console.info(pic);
//
//        $(document).on('click','.fd-imgs img',function () {
//            $.photoBrowser({
//                photos : pic,
//                type: 'popup'
//            }).open();
//            //myPhotoBrowserPopup.open();
//        });

    })
</script>