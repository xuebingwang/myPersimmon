
@section('style_nav')
<style>
.modal{ width: 85%; top:5%;left: 7%;}
.modal-inner,.modal-buttons{ background: #fff;}
.modal-buttons{ border-radius: 0 0 0.35rem 0.35rem !important; padding-bottom: .4rem;}
.modal-button{
    background: rgb(206,53,48);
    border-radius: 1rem !important;
    width: 80%; margin: 0 auto; color: #fff;
}
.list-block{
    margin: 0;
    font-size: .3rem;
}
.list-block .item-content,.list-block .item-inner{ height: auto; padding: 0; min-height: .9rem;}
.list-block input[type=text], .list-block input[type=password], .list-block input[type=email], .list-block input[type=tel], .list-block input[type=url], .list-block input[type=date], .list-block input[type=datetime-local], .list-block input[type=time], .list-block input[type=number], .list-block input[type=search], .list-block select, .list-block textarea
{ font-size: .3rem; height: auto}
</style>
@endsection
<div class="footer clearfix">
    <?php
    $segment = Request::segment(1);

    ?>
    <a href="/" class="f1 @if($segment == '' || $segment == 'index') on @endif">
        <span class="icon icon-home"></span>
        <span>首页</span>
    </a>
    <a href="javascript:" class="f2">
        <span class="icon icon-attention top"></span>
        <span>艺展</span>
    </a>
    <a href="javascript:" class="f3 banzhan">
        <span class="icon icon-roundadd top"></span>
        <span>办展</span>
    </a>
    <a href="{{route('art_circle_recommend')}}" class="f4 @if($segment == 'art_circle') on @endif">
        <span class="icon icon-process"></span>
        <span>圈子</span>
    </a>
    <a href="{{route('member_index')}}" class="f5 @if($segment == 'member') on @endif">
        {{--<i>3</i>--}}
        <span class="icon icon-person2"></span>
        <span>我的</span>
    </a>
</div>
<div id="banzhan-form" style="display: none">
    <div class="list-block">
        <form action="{{route('api_bzsq')}}" class="ajax-form sq-form">
        <ul>
            <!-- Text inputs -->
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">手机号码</div>
                        <div class="item-input">
                            <input type="text" name="mobile" placeholder="您的手机号码">
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">昵称</div>
                        <div class="item-input">
                            <input type="text" name="nickname" placeholder="您的称呼">
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">分类</div>
                        <div class="item-input">
                            <select name="category">
                                <option value="国画">国画</option>
                                <option value="油画">油画</option>
                                <option value="水彩画">水彩画</option>
                                <option value="版画">版画</option>
                                <option value="工艺画">工艺画</option>
                                <option value="插画">插画</option>
                                <option value="漫画">漫画</option>
                                <option value="漫画">漫画</option>
                            </select>
                        </div>
                    </div>
                </div>
            </li>
            <!-- Select -->
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">性别</div>
                        <div class="item-input">
                            <select name="sex">
                                <option value="男">先生</option>
                                <option value="女">女士</option>
                            </select>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">年龄</div>
                        <div class="item-input">
                            <input type="text" name="age" placeholder="">
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-title label">所在地</div>
                        <div class="item-input">
                            <input type="text" name="address" placeholder="">
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        </form>
        <p style="text-align: left; padding: .8rem 0;">
            备注：办展申请1-2个工作日通过后，需提交至少10副作品才可办展，作品高清手机拍照图片1920x1080分辨率即可。
            如需通过我方平台在线交易，需签署授权协议由我方统一制作版画销售按每副伤口10-15%税后分成，伤口城另提交高清数码照片或扫描图片300DPI值。
        </p>
    </div>
</div>
@section('scripts_nav')
<script>

$(document).on('click','.banzhan', function () {
    $.modal({
        title:  '免费办展申请',
        text: '' +
        '<div style="font-size: 12px;text-align: left; background: rgb(220,220,220); border-radius: .35rem; padding: .2rem;">' +
        '<p>猫眼艺术传播体验馆致力于国家艺术文化大战略，倡导艺术文化走进生活、走进大众，以艺术传播教育为己任，将艺术美从儿童抓起。通过线上VR猫眼艺术馆体验场景，让美的灵魂伤口快速传播到亿万用户中去，让普通用户"走进艺术，走进生活"，让艺术家办个展更容易，让艺术美离我们更近。</p>' +
        '<p>新申请会员享有30天免费体验期，体验期满后想继续使用需充值使用（100元/30天，300元/180天，600元/360天，1200元/560天），申请认证会员享有每年60天免费体验。同时展览将永久保留，您可以随时随地开展，分享您的亲朋好友展示您的才华，让您的粉丝零距离和您交流。</p>' +
        '<img src="/cateyeart/v2/images/133.png" width="100%">' +
        '</div>',
        verticalButtons: true,
        buttons: [
            {
                text: '下一步',
                onClick: show_form
            },
        ]
    })
});
function show_form() {
    $.modal({
        title:  '免费办展申请',
        text: $('#banzhan-form').html(),
        verticalButtons: true,
        buttons: [
            {
                text: '提交',
                onClick: function() {
                    console.info()
                    $('.modal .sq-form').submit();
                }
            },
        ]
    })
}
</script>
@endsection