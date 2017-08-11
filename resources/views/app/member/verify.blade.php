@extends('app.layouts.cateyeart')

@section('style')
<style>
    .page .bar.bar-footer{ bottom: 0; padding-bottom: .5rem; height: auto !important; border-bottom: 0;}
    .ios-not-nav header.bar-nav {
        display:none !important
    }
    .bar-nav {
        padding-left:0;
        padding-right:0;
        background:#fff
    }
    .bar .button-nav.pull-left {
        margin:0
    }
    .bar-nav
    .back {
        width:40px;
        height:44px;
        background:url(/cateyeart/img/6.png?v=1487071089) center no-repeat;
        background-size:10px 19px
    }
    .page {
        max-width:100%;
        margin:0
        auto;
        background:#fff
    }
    .title {
        width:100%;
        max-width:100%;
        margin:0
        auto;
        font-size:0.8rem;
        font-weight:400
    }
    .notice {
        padding:2rem 1rem 4rem 1rem
    }
    .copy {
        padding-bottom:1.2rem
    }
    .copy
    h3 {
        font-size:0.7rem;
        font-weight:500;
        padding-bottom:1.2rem
    }
    .copy
    p {
        font-size:0.7rem;
        font-weight:400;
        padding-bottom:1rem
    }
    .verify-btn-box {
        height:60px
    }
    .verify-btn1 {
        width:100%;
        line-height:40px;
        font-size:14px;
        text-align:center;
        color:#fff;
        display:inline-block;
        font-weight:500;
        background:#000;
        height:40px
    }
    .form-agreen .checkboxWarp
    input {
        opacity:0
    }
    .form-agreen
    input {
        width:14px;
        height:14px;
        border:solid 1px #cfd1d3;
        vertical-align:middle;
        padding:0;
        margin:0
    }
    .form-agreen {
        width:100%;
        padding:0.3rem 0;
        font-size:0.6rem;
        line-height:24px;
        text-align:center
    }
    .bar-standard {
        position:relative
    }
    .bar-standard:before {
        content:'';
        position:absolute;
        left:0;
        top:0;
        bottom:auto;
        right:auto;
        height:1px;
        width:100%;
        background-color:#ebebeb;
        display:block;
        z-index:15;
        -webkit-transform-origin:50% 0%;
        transform-origin:50% 0%
    }
    .site-li-block
    h3 {
        padding-left:0.75rem;
        font-size:0.6rem;
        padding-bottom:0.4rem;
        font-weight:400;
        color:#9C9C9C
    }
    .embeddedbody .content
    .notice {
        padding:1rem 1rem 1rem 1rem
    }
    .private_card
    h3 {
        font-size:14px;
        line-height:24px;
        font-weight:normal
    }
    .private_box .img_Box
    img {
        width:100%
    }
    .private_box .text_Box
    p {
        line-height:22px
    }
    .sign_spread_out
    ul {
        height:260px;
        overflow-y:scroll
    }
    .sign_spread_out ul
    li {
        padding:10px
        5px;
        border-bottom:1px dotted #DFDFDF;
        cursor:pointer
    }
    .sign_spread_out ul .head .btn
    img {
        width:100%;
        height:100%
    }
    .sign_spread_out ul
    h3 {
        text-align:left;
        font-size:14px;
        overflow:hidden;
        text-overflow:ellipsis;
        white-space:nowrap;
        display:inline-block;
        width:80%
    }
    .sign_spread_out ul h3
    a {
        color:#2c2b2a;
        display:inline-block;
        overflow:hidden;
        text-overflow:ellipsis;
        white-space:nowrap;
        float:left;
        max-width:10em
    }
    .letter_warp .phiz .phiz_btn_a
    input {
        height:32px;
        left:0;
        opacity:0;
        position:absolute;
        top:0;
        width:100%;
        cursor:pointer
    }
    .one-step-tip
    h3 {
        font-size:0.7rem;
        text-align:center;
        padding-bottom:0.5rem;
        padding-top:0.5rem
    }
    .one-step-tip
    p {
        font-size:0.7rem;
        line-height:24px;
        padding:0.3rem 0;
        text-align:center
    }
    .verify-pop-modal.verify-pop-modal01 .modal-inner .one-step-tip
    p {
        color:#fff
    }
</style>
@endsection
@section('title', '申请认证')
@section('body-style', 'verify-body ')
<div class="page-group">
    <div class="page page-current">
        <header class="bar bar-nav">
            <a href="/" class="button button-link button-nav pull-left back"></a>
            <h1 class="title">申请猫眼艺术艺术家认证</h1></header>
        <div class="content native-scroll">
            <div class="notice">
                <div class="copy">
                    <h3>1、什么是猫眼艺术认证服务?</h3>
                    <p>答：猫眼艺术认证服务是对职业艺术家的身份真实性证明，以更好地帮助他们获得更多有价值的曝光，鼓励收藏家和粉丝群体关注他们。猫眼艺术的认证用户具有很高的审美品位、专业素养及商业价值，这等同于猫眼艺术平台的品牌价值。</p>
                </div>
                <div class="copy">
                    <h3>2、任何人都可以申请吗?</h3>
                    <p>答：No！目前我们仅接受从事绘画、雕塑、影像、装置、行为艺术、综合材料、插画、数码及新媒体艺术等专业领域创作的艺术家的认证申请。至于申请者是否可以通过认证，将由猫眼艺术审核团队针对申请者的身份真实性、作品专业度、平台内活跃度进行判定，因此我们不保证对所有申请者都进行认证。</p>
                </div>
                <div class="copy">
                    <h3>3、如何通过申请认证？</h3>
                    <p>答：想要获得认证需满足以下条件：</p>
                    <p>a. 已经在猫眼艺术发表了至少10件作品</p>
                    <p>b. 账号内头像必须为本人的真实头像</p>
                    <p>c. 已经在个人主页的“简介”页面填写过真实完善的个人简介</p>
                </div>
                <div class="copy">
                    <h3>4、成为认证用户后有什么特权？</h3>
                    <div class="spacing">
                        <p>答：1 ）获得“我的统计”增值服务：该服务将为您全面展示个人主页的访问数据、互动数据、交易数据等信息， 以帮助您更好的了解个人数据和粉丝、藏家群体的行为特征。认证用户之外的其他用户无法使用统计功能。</p>
                    </div>
                    <div class="spacing">
                        <p>2）个人主页的酷炫封面：在认证用户的个人主页首屏位置设置了酷炫的封面功能，您可以自主设定该封面的使用图片。这有助于更美观、更个性化的展示您的艺术风格和品牌形象。</p>
                    </div>
                    <div class="spacing">
                        <p>3）置顶功能：个人主页的首页，展示了您最新发表的所有作品。认证用户可以选择自己最满意或最希望推荐给粉丝群体的1件作品置顶在显著位置。</p>
                    </div>
                    <div class="spacing">
                        <p>4）原创保护：认证用户发表的所有作品页面都会标记有“版权保护图标”，这样使得您的作品在展示给藏家或粉丝群体之时会更具公信力。但是，一旦您的作品遭到举报或被平台证实为虚假、恶意、违法、或有版权纠纷的作品，该保护自动失效并撤销这件作品的永久展示权。“原创保护”功能的目的是鼓励艺术家们发表真实的作品并帮助大家促成交易、合作。</p>
                    </div>
                    <div class="spacing">
                        <p>5）被打赏：任何用户都可以通过安卓客户端或猫眼艺术网页版向认证艺术家进行打赏，以鼓励认证艺术家持续地创作出更多的优秀作品。只有认证艺术家才具备“被打赏”的功能。如果您的账号活跃度高、粉丝量大、粉丝忠诚度出色的话，“打赏”所带来的收入也绝对不可小觑。</p>
                    </div>
                    <div class="spacing">
                        <p>6）原图存储：认证艺术家上传作品时，服务器将免费为您保存2T的原图，超过2T将额外收取空间使用费。但是实际情况是，2T容量已经足够存储您99%的作品图片了，只要您不胡乱使用猫眼艺术宝贵的服务器资源， 您将不需要为空间存储付费。</p>
                    </div>
                    <div class="spacing">
                        <p>7）在线销售作品权限：认证用户在认证成功后将同时获得“在线出售作品”的资质，您发表的每一件作品都可以直接通过在线支付的形式购买，这样更方便、快捷、 体验更出色，而且系统会为您存储每一位买家用户的资 料信息以便于未来的定向推荐。每一件在线出售的作品 页面都将显示“收藏家”的名字。如果您在猫眼艺术在线出售超过10件的作品，那么在您需要作品估价（比如快递时损坏索赔）时，猫眼艺术将会协助您向索赔方提供真实有效的作品价值证明。</p>
                    </div>
                    <div class="spacing">
                        <p>8）封面共享计划的申请资格：所有认证艺术家都具有申请“封面共享计划”的资格，此共享计划旨在通过猫眼艺术 App的开屏封面，将认证艺术家的优质作品更大范围地推荐给目标用户，以得到更多的关注与曝光。</p>
                    </div>
                    <div class="spacing">
                        <p>9）更多功能敬请期待：我们非常珍惜和尊重每一位认证用户，力求为大家提供更多、更专业的增值服务。</p>
                    </div>
                </div>
                <div class="copy">
                    <h3>5、认证有有效期吗？</h3>
                    <p>答： 认证成功后，该帐号及认证特权将在您选择的认证期内完全有效（自认证成功之日起计算）。如果认证用户超过三个月未登录，将会被系统自动撤销认证特权，且认证服务费不予退还。</p>
                </div>
                <div class="copy">
                    <h3>6、你们收佣金吗？</h3>
                    <p>答：会，为了更好的提供服务质量，猫眼艺术会向认证用户收取相当于成交后作品售价的10%作为服务费，以用于抵扣画款在三方（收藏家-猫眼艺术-艺术家）转付过程中产生的手续费用及猫眼艺术团队在研发并运营本平台时的基础开支。相对于免费用户来说，也许这项收费不便宜，但是对于能够卖掉作品的职业艺术家来说，相信每一个人都会认同这10%背后的增值价值。收取佣金并不是我们的终极目的，我们更希望与艺术家、艺术机构实现共赢，让艺术品的交易流转更简单，让艺术家和艺术机构们获得更多的客户资源！</p>
                </div>
                <div class="copy">
                    <h3>7、认证艺术家是否可以与用户互换联系方式或引导用户使用其他渠道进行交易？</h3>
                    <p>答：NO！艺术家申请认证一旦通过，即代表您已阅读并同意猫眼艺术认证条款，所有认证艺术家禁止与站内其他用户通过私信交换联系方式。认证艺术家在线销售的作品，同样不得绕过猫眼艺术平台，使用淘宝、微信支付等其他第三方渠道完成购买。一旦发现认证艺术家通过私信与用户交换微信、手机号、QQ等联系方式，或有引导用户进行第三方渠道交易的行为，猫眼艺术则有理由认为该艺术家存在信用问题，并与之结束全部合作（包括但不限于艺术家认证及站内推广曝光等），或永久剥夺其猫眼艺术平台使用权。</p>
                </div>
                <div class="copy">
                    <h3>8、申请成为认证艺术家是否收取费用？</h3>
                    <p>答：是，猫眼艺术会向每一位申请认证成功的艺术家用户收取服务费用，服务费用以月、季度、年三个不同时间段进行收取，具体费用以认证流程中具体显示的数字为准。在认证期满时，猫眼艺术将通过系统自动提醒您续费，以持续享受认证艺术家特权。</p>
                </div>
            </div>
        </div>
        <form class="bar bar-standard bar-footer verify-btn-box">
            <div class="form-agreen">
                <label>
                    <input type="checkbox" name="agree" class="agree" value="1" autocomplete="off" checked="checked">
                    <span>认证通过即代表同意在猫眼艺术上销售作品</span></label>
            </div>
            <a class="verify-btn1 btn-next" href="{{route('member_verify_apply')}}">我已了解，继续下一步</a>
        </form>
    </div>
</div>
{{--<div class="preloader-indicator-overlay"></div>--}}
{{--<div class="preloader-indicator-modal"><span class="preloader preloader-white"></span></div>--}}
@section('content')

@endsection

@section('scripts')
<script>

    var disCls = 'ash',
        $next = $('.btn-next');
    $('.agree').on('click',function(ev) {
        $next.toggleClass(disCls, !$(this).prop('checked'));
        return;
    });
    $next.click(function () {
        if(!$('input[name=agree]').prop('checked')){
           return false;
        }
        @if($work_count < 10)
        $.alert('必须在猫眼艺术发表至少10件作品','申请认证条件');
        return false;
        @endif
    })
</script>
@endsection