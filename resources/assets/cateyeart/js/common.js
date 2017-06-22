/**
 * Created by xuebingwang on 2017/6/8.
 */

var $ = require('jquery')

/**
 * 以字符串形式执行方法
 * @param func
 * @param args
 * @param defaultValue
 * @returns {*}
 */
var calculateFunctionValue = function (func, args, defaultValue) {
    if (typeof func === 'string') {
        // support obj.func1.func2
        var fs = func.split('.');

        if (fs.length > 1) {
            func = window;
            $.each(fs, function (i, f) {
                func = func[f];
            });
        } else {
            func = window[func];
        }
    }
    if (typeof func === 'function') {
        return func.apply(null, args);
    }
    return defaultValue;
};
String.prototype.len=function(){return this.replace(/[^\x00-\xff]/g,"__").length;}

$(function () {
    function ajax_post(url,data){
        var $this = $(this);
        var node_name = $this.get(0).nodeName;
        if(node_name == 'FORM'){
            var sb_btn = $this.find('[type=submit]').prop("disabled", true);
        }else if(node_name == 'BUTTON' || node_name == 'INPUT'){
            var sb_btn = $this;
        }

        cat.showPreloader();

        data.push({name:'_token',value:cat.csrf_token});

        $.post(url,data,function(resp){
            if(resp.status == '0'){

                if(resp.url != '' && resp.msg == ''){
                    //返回url不为空并且消息为空
                    window.location = resp.url;
                }else if(resp.msg != '' && resp.url != null && resp.url != '' ){
                    //返回信息与url都不为空
                    cat.success(resp.msg,function(){
                        window.location = resp.url;
                    });
                }else if(resp.msg != ''){

                    //返回消息为空
                    cat.success(resp.msg,function(){
                        calculateFunctionValue($this.attr('submit_success'),[$this,resp],'');


                        if($this.hasClass('refresh')){

                            window.location.href = window.location.href;
                        }
                    });
                }else if(resp.msg == '' && resp.url == ''){
                    //返回信息与url都为空
                    calculateFunctionValue($this.attr('submit_success'),[$this,resp],'');


                    if($this.hasClass('refresh')){

                        window.location.href = window.location.href;
                    }
                }
            }else{

                if(resp.url == null || resp.url == ''){
                    cat.error(resp.msg,function(){
                        calculateFunctionValue($this.attr('fail'),[$this,resp],'');
                    });
                }else{
                    cat.error(resp.msg,function(){
                        window.location = resp.url;
                    });
                }
            }
        },'json').always(function () {
            cat.hidePreloader();
            sb_btn.prop('disabled',false);
        });
    }

    $(document).on('submit','.ajax-form',function(){
        var $this = $(this);

        var flag = calculateFunctionValue($this.attr('before_submit'),[$this],'');
        if(typeof flag == 'boolean' && !flag){
            return false;
        }
        if($this.hasClass('confirm')){

            var _this = this;
            var index = cat.confirm($this.data('msg')||'您确认提交请求？', function(){
                ajax_post.apply(_this,[_this.action,$this.serializeArray()]);
            });
        }else{
            ajax_post.apply(this,[this.action,$this.serializeArray()]);
        }

        return false;
    });
});
