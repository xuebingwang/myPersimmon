var is_loading = false;
var distance = $('#distance').val();

distance = (distance == null ? 100 : parseInt(distance));
// console.info(distance);
// $(function () {
//     alert('浏览器当前窗口可视区域高度。'+$(window).height()); //浏览器当前窗口可视区域高度
//     alert('浏览器当前窗口文档的高度。'+$(document).height()); //浏览器当前窗口文档的高度
//     alert('浏览器当前窗口文档body的高度。'+$(document.body).height());//浏览器当前窗口文档body的高度
//     alert('浏览器当前窗口文档body的总高度 包括border padding margin。'+$(document.body).outerHeight(true));//浏览器当前窗口文档body的总高度 包括border padding margin
//
//     alert(window.screen.height);
//     // alert($(window).width()); //浏览器当前窗口可视区域宽度
//     // alert($(document).width());//浏览器当前窗口文档对象宽度
//     // alert($(document.body).width());//浏览器当前窗口文档body的宽度
//     // alert($(document.body).outerWidth(true));//浏览器当前窗口文档body的总宽度 包括border padding margin
//
// })
$(window).scroll(function(){
    // console.info($(document).height());
    // console.info($(this).scrollTop());
    // console.info($(this).height());

    // console.info($(document).height() - $(this).scrollTop() - window.screen.height);
    if ($(document).height() - $(this).scrollTop() - window.screen.height < distance){

        var next_url = $('#next-url').val();
        if(next_url == '' || is_loading){
            return false;
        }
        is_loading = true;

        $.showPreloader('加载下一页');
        $.get(
            next_url,
            {random:Math.random()},
            function(resp){
                if(resp.status == '0'){
                    // console.log(resp);
                    $("#item-wrap").append(resp.data.html);
                    $('#next-url').val(resp.url);
                } else {

                    $('#next-url').val('');
                }
            },
            'json'
        ).always(function () {
            is_loading = false;
            $.hidePreloader();
        });
    }
});