<script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
{{--<link rel="stylesheet prefetch" href="http://cdn.cdnjs.net/photoswipe/4.1.2/photoswipe.min.css">--}}
{{--<link rel="stylesheet prefetch" href="http://cdn.cdnjs.net/photoswipe/4.1.2/default-skin/default-skin.min.css">--}}
{{--<script src="http://cdn.cdnjs.net/photoswipe/4.1.2/photoswipe.min.js"></script>--}}
{{--<script src="http://cdn.cdnjs.net/photoswipe/4.1.2/photoswipe-ui-default.min.js"></script>--}}
{{--<script src="https://cdn.bootcss.com/light7/0.4.3/js/light7-swiper.min.js"></script>--}}
<script src="https://cdn.bootcss.com/jquery.swipebox/1.4.4/js/jquery.swipebox.js"></script>
<script src="/cateyeart/js/scroll.page.js"></script>
<script>


    function star_success(obj,resp) {
        $('.btn_follow'+resp.data.mid).addClass('follow_btn').removeClass('ajax-get').attr('submit_success','unstar_success').text('关注');
    }
    function unstar_success(obj,resp) {
        $('.btn_follow'+resp.data.mid).removeClass('follow_btn').addClass('ajax-get').attr('submit_success','star_success').text('关注');
    }

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



        $(document).on('click','.follow_btn',function(){
            var group = [{
                text: '<a href="'+this.href+'" class="ajax-get" submit_success="unstar_success">取消关注</a>',
                color: 'danger',
                close: false
            },
                {
                    text: '取消'
                }];
            var modal = $.actions([group]);
            return false;
        });

    })
</script>