/*
 * send verify sms
 *---------------------------
 * top lan <toplan710@gmail.com>
 * https://github.com/toplan/laravel-sms
 * --------------------------
 * Date 2015/06/08
 */
(function($){
    $.fn.sms = function(options) {
        var self = this;
        var btnOriginContent, timeId;
        var opts = $.extend(true, {}, $.fn.sms.defaults, options);
        self.on('click', function (e) {
            btnOriginContent = self.html() || self.val() || '';
            changeBtn(opts.language.sending, true);
            send();
        });

        function send() {

            var url = getUrl();
            var requestData = getRequestData();
            $.ajax({
                url     : url,
                type    : 'post',
                data    : requestData,
                success : function (data) {
                    opts.notify.call(null, data);
                    if (data.success) {
                       timer(opts.interval);
                    } else {
                       changeBtn(btnOriginContent, false);
                    }
                },
                error   : function(xhr, type){
                    changeBtn(btnOriginContent, false);
                    opts.notify.call(null, {success:false,message:opts.language.failed, type:'request_failed'});
                }
            });
        }

        function getUrl() {
            var domain = opts.domain || '';
            var prefix = opts.prefix || 'laravel-sms';
            if (opts.voice) {
                return domain + '/' + prefix + '/voice-verify';
            }

            return domain + '/' + prefix + '/verify-code';
        }

        function getRequestData() {
            var requestData = { _token: opts.token || '' };
            var data = $.isPlainObject(opts.requestData) ? opts.requestData : {};
            $.each(data, function (key) {
                if (typeof data[key] === 'function') {
                    requestData[key] = data[key].call(requestData);
                } else {
                    requestData[key] = data[key];
                }
            });

            return requestData;
        }

        function timer(seconds) {
            var btnText = opts.language.resendable;
            btnText = typeof btnText === 'string' ? btnText : '';
            if (seconds < 0) {
                clearTimeout(timeId);
                changeBtn(btnOriginContent, false);
            } else {
                timeId = setTimeout(function() {
                    clearTimeout(timeId);
                    changeBtn(btnText.replace('{{seconds}}', (seconds--) + ''), true);
                    timer(seconds);
                }, 1000);
            }
        }

        function changeBtn(content, disabled) {
            self.html(content);
            self.val(content);
            self.prop('disabled', !!disabled);
        }
    };

    $.fn.sms.defaults = {
        token       : null,
        interval    : 60,
        voice       : false,
        domain      : null,
        prefix      : 'laravel-sms',
        requestData : null,
        notify      : function (data) {
            if(data.success){
                cat.success(data.message);
            }else{
                cat.error(data.message);
            }
        },
        language    : {
            sending    : '短信发送中...',
            failed     : '请求失败，请重试',
            resendable : '{{seconds}} 秒后再次发送',
        }
    };

    $('#send-sms').sms({
        //laravel csrf token
        token       : cat.csrf_token,
        //请求间隔时间
        interval    : 60,
        prefix      : cat.sms_route_prefix,
        //请求参数
        requestData : {
            //手机号
            mobile : function () {
                return $('input[name=mobile]').val();
            },
            captcha : function () {
                return $('input[name=captcha]').val();
            },
            //手机号的检测规则
            mobile_rule : 'check_mobile_unique',
            captcha_rule: 'captcha'
        }
    });

    $('img.btn-fresh').data('src',$('img.btn-fresh').attr('src')).click(function(ev) {
        var $this = $(this),
            src = $this.data('src');
        $this.attr('src', src + Math.random());
        return false;
    });


})(window.jQuery || window.Zepto);
