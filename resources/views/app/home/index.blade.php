@extends('app.layouts.cateyeartv2')

@section('title', '猫眼艺术')
@section('content')

    @include('app.common.index_header')

    <!-- banner -->
    <div class="sy-banner">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($banners as $banner)
                <div class="swiper-slide">
                    <a href="{{$banner->url}}">
                        <img src="http://mall.cateyeart.com/attachment/{{$banner->thumb}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="main-menu clearfix">
        <a href="javascript:;">
            <img src="/cateyeart/v2/images/dasai.png" alt="">
            艺展大赛
        </a>
        <a href="{{route('member_verify')}}">
            <img src="/cateyeart/v2/images/renzheng.png" alt="">
            认证会员
        </a>
        <a href="javascript:;" id="shuzizhengshu">
            <img src="/cateyeart/v2/images/zhengshu.png" alt="">
            数字证书
        </a>
    </div>

    <!-- 推荐展览 -->
    <div class="hot-pro-lists">
        <div class="hot-pro-tit">推荐展览</div>
        <ul id="hot-works">
            @foreach($works as $item)
            <li>
                <div class="hot-opus">
                    <a href="{{$vr_url}}tour/{{$item['view_uuid']}}">
                        <img src="{{$item['thumb_path']}}" height="180" alt="">
                        <span class="gplay"></span>
                    </a>
                    <span class="nmb-txt">免费展览</span>
                </div>
                <div class="hot-author clearfix">
                    <div class="hot-author-txt">
                        <div class="clearfix hotnbox">
                            <div class="hot-author-name">{{$item['name']}}</div>
                        </div>
                        <a class="hot-zan" href="javascript:">
                            <span class="icon icon-like"></span>
                            {{$item['browsing_num']}}
                        </a>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

    @include('app.common.nav')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ mix('cateyeart/js/app.js') }}"></script>
    <script>
        // banner
        new Swiper ('.sy-banner .swiper-container', {
            loop: true,
            autoplay : 5000,
            speed:800,
            autoplayDisableOnInteraction : false,
            pagination: '.swiper-pagination'
        })
        var zs_tip = '备注：数字证书报名申请通过后，需登录猫眼艺术公众号手机上传提交至少10副作品即可VR艺术办展，' +
            '通过分享链接或图片二维码给审核组委会评审通过后，由组委会颁发证书。<br>' +
            '上传如有问题，可以将作品发到邮箱2594134988@qq.com即可。';

        $(document).on('click','#shuzizhengshu', function () {
            $.modal({
                title:  '数字证书申请',
                text: '' +
                '<div style="font-size: 12px;text-align: left; background: rgb(220,220,220); border-radius: .35rem; padding: .2rem;">' +
                '<p>数字证书是由借山画馆和市文化教育局组织承办由猫眼艺术传播体验馆提供。线上VR猫眼艺术馆体验场景，让美的灵魂作品快速传播到亿万用户中去，让普通用户"走进艺术，走进生活"，让艺术家办个展更容易，让艺术美离我们更近。</p>' +
                '<p>倡导国家艺术文化大战略，培养少年儿童的德、智、体、美文化教育，全面发展为己任。</p>' +
                '<img src="/cateyeart/v2/images/133.png" width="100%">' +
                '</div>',
                verticalButtons: true,
                buttons: [
                    {
                        text: '下一步',
                        onClick: function () {
                            show_form(2,'数字证书申请',zs_tip)
                        }
                    },
                ]
            })
        });


        <?php if (isset($show) && $show == 'cooperate_apply'):?>
        show_cooperate_apply();
        <?php endif;?>

        var jiameng_tip = '备注：申请通过后，猫眼艺术会由专人负责联系合作事宜，也可以将资料发到邮箱2594134988@qq.com即可。';
        function show_cooperate_apply() {
            $.modal({
                title:  '免费办展申请',
                text: '' +
                '<div style="font-size: 12px;text-align: left; background: rgb(220,220,220); border-radius: .35rem; padding: .2rem;">' +
                '<p>欢迎关注画品画，猫眼艺术是一家VR艺术传播教育体验服务商，免费为艺术家和少儿美术培训机构提供VR艺术展、艺术直播、艺术教育学习，提供用户在线看展、学习、在线购买作品。</p>' +
                '<p>加盟商需是服务于美术行业，个人、机构、协会群体，由加盟商负责线下美术爱好者教育，培训组织猫眼艺术提供线上VR展览推广，建立线上线下结合服务于美术事业，详细加盟合作模式请提交资料后我方由专人负责联系开通。</p>' +
                '<img src="/cateyeart/v2/images/133.png" width="100%">' +
                '</div>',
                verticalButtons: true,
                buttons: [
                    {
                        text: '下一步',
                        onClick: function () {
                            show_form(3,'加盟合作',jiameng_tip)
                            $('.modal select[name=category]').html('' +
                                '<option value="个人">个人</option>' +
                                '<option value="学校">学校</option>' +
                                '<option value="机构">机构</option>' +
                                '<option value="协会">协会</option>');
                        }
                    },
                ]
            })
        }
    </script>
@endsection
