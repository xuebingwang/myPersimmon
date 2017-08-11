<script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
<script src="http://img1.huapinhua.com/xbw.js?20170804"></script>
<script src="http://img1.huapinhua.com/city_all.js?20170623"></script>
<script>
@if(!empty($me))
function add_comment_success(form,resp) {
    var _html = '<li class="comment-record clearfix">' +
                    '<div class="reward-photo fl">' +
                        '<a href="'+resp.data.domain+'">' +
                            '<img src="'+resp.data.avatar+'" class="photo">' +
                        '</a>' +
                        '</div>' +
                        '<div class="comment-detail">' +
                            '<div class="comment-detail-top clearfix">' +
                                '<div class="comment-detail-left fl">' +
                                    '<div class="top clearfix">' +
                                        '<a class="name fl" href="'+resp.data.domain+'">'+resp.data.member_name+'</a>' +
                                    '</div>' +
                                    '<div class="bottom">' +
                                    '<span>刚刚</span>' +
                                    '<span>' +
                                        '<i class="icon site-icon"></i>'+XBW.linkage.findVbyK(resp.data.member_city_id)[1] +
                                    '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="comment-detail-content">' +
                            '<p>'+resp.data.content+'</p>' +
                        '</div>' +
                    '</div>' +
                '</li>';

    $('#comment-content,#comment-pid').val('');

    $('#comment_list').prepend(_html);
}
@endif
</script>