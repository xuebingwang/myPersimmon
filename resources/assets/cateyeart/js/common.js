/**
 * Created by xuebingwang on 2017/6/8.
 */


/* global $:true */
+ function($) {
    "use strict";

    $.pic_upload = function(selector,callback) {

        var pic_upload = function() {  // you can ues 'onchange' here to uplpad automatically after select a file
            var $this = $(this);
            var selectedFile = $this.val();


            if (selectedFile == '') {
                // randomly generate the final file name
                // file_name = Math.random().toString(36).substr(2) + $this.val().match(/\.?[^.\/]+$/);
            // } else {

                return false;
            }

            var fileReader = new FileReader();
            var blobSlice = File.prototype.mozSlice || File.prototype.webkitSlice || File.prototype.slice,
                file = this.files[0],
                chunkSize = 2097152,
                // read in chunks of 2MB
                chunks = Math.ceil(file.size / chunkSize),
                currentChunk = 0,
                spark = new SparkMD5();

            function loadNext() {
                var start = currentChunk * chunkSize,
                    end = start + chunkSize >= file.size ? file.size : start + chunkSize;

                fileReader.readAsBinaryString(blobSlice.call(file, start, end));
            };

            loadNext();

            fileReader.onload = function(e) {

                // console.log("read chunk nr", currentChunk + 1, "of", chunks);
                spark.appendBinary(e.target.result); // append binary string
                currentChunk++;

                if (currentChunk < chunks) {
                    loadNext();
                }

                else {
//                console.info("computed hash", spark.end()); // compute hash
                    // if (!file_name.toLowerCase().match(/\.(jpg|jpeg|png|gif)$/)) {
                    //     alert('上传的图片类型不正确!');
                    //     return false;
                    // }

                    var file_name = spark.end()+$this.val().match(/\.?[^.\/]+$/);

                    new FormData()
                    var data = new FormData();

                    data.append('token',cat.upload_token);
                    data.append('key',file_name);
                    data.append('file',file);

                    $.ajax({
                        url: 'http://up-z2.qiniu.com/',  // Different bucket zone has different upload url, you can get right url by the browser error massage when uploading a file with wrong upload url.
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        xhr: function(){
                            var myXhr = $.ajaxSettings.xhr();
                            if(myXhr.upload){
                                myXhr.upload.addEventListener('progress',function(e) {
                                    // console.log(e);
                                    if (e.lengthComputable) {
                                        var percent = e.loaded/e.total*100;
                                        console.info('上传：' + e.loaded + "/" + e.total+" bytes. " + percent.toFixed(2) + "%");
                                    }
                                }, false);
                            }
                            return myXhr;
                        },
                        success: function (res) {
                            callback.apply(file,[res,$this]);
                        },
                        error: function(res) {
                            console.log("失败:" +  JSON.stringify(res));
                            console.error('上传失败：' + res.responseText);
                        }
                    });
                }
            };

            return false;
        };

        if(cat.upload_token == null){

            $.get('/api/upload_token',function(resp){
                cat.upload_token = resp.upload_token;
                // $(selector).on('change',pic_upload);
                $(document).on('change',selector,pic_upload);
            },'json');
        }else{

            // $(selector).change(pic_upload);
        }
    };

}($);

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

String.prototype.len=function(){return this.replace(/[^\x00-\xff]/g,"__").length;};

$(function(){
    function ajax_post(url,data){
        var $this = $(this);
        $.showPreloader();

        data.push({name:'_token',value:cat.csrf_token});

        $.post(url,data,function(resp){
            if(resp.status == '0'){

                if(resp.url != '' && resp.msg == ''){
                    //返回url不为空并且消息为空
                    window.location = resp.url;
                }else if(resp.msg != '' && resp.url != null && resp.url != '' ){
                    //返回信息与url都不为空
                    $.success(resp.msg,function(){
                        window.location = resp.url;
                    });
                }else if(resp.msg != ''){

                    //返回消息为空
                    $.success(resp.msg,function(){
                        if($this.hasClass('refresh')){

                            window.location.href = window.location.href;
                        }
                    });
                }else if(resp.msg == '' && resp.url == ''){
                    //返回信息与url都为空
                    if($this.hasClass('refresh')){

                        window.location.href = window.location.href;
                    }else{

                        $.hidePreloader();
                    }
                }
                calculateFunctionValue($this.attr('submit_success'),[$this,resp],'');
            }else{

                if(resp.url == null || resp.url == ''){
                    $.error(resp.msg,function(){
                        calculateFunctionValue($this.attr('fail'),[$this,resp],'');
                    });
                }else{
                    $.error(resp.msg,function(){
                        window.location = resp.url;
                    });
                }
            }
        },'json').always(function () {
            // $.hidePreloader();
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
            var index = $.confirm($this.data('msg')||'您确认提交请求？', function(){
                ajax_post.apply(_this,[_this.action,$this.serializeArray()]);
            });
        }else{
            ajax_post.apply(this,[this.action,$this.serializeArray()]);
        }

        return false;
    });

    $(document).on('click','.ajax-get',function(){
        var target;
        var $this = $(this);
        var flag = calculateFunctionValue($this.attr('before'),[$this],'');
        if(typeof flag == 'boolean' && !flag){
            return false;
        }

        if ( $this.hasClass('confirm') ) {
            $.confirm($this.data('msg')||'确认要执行该操作吗？',$this.data('title')||'提示', function(){
                ajax_get();
            });
            return false;
        }else{
            ajax_get();
        }

        function ajax_get(){
            if ( (target = $this.attr('href')) || (target = $this.attr('url')) ) {
                $.showPreloader();
                $.get(target,function(resp){
                    if (resp.status == '0') {

                        if(resp.url && $this.hasClass('no-refresh')){
                            $this.attr('url',resp.url);
                        }else if(resp.url){
                            if(resp.url == 'refresh'){
                                $.success(resp.msg,function () {
                                    window.location = window.location;
                                });
                            }else if (!$this.hasClass('no-refresh')) {
                                $.success(resp.msg,function () {
                                    location.href=resp.url;
                                });
                            }
                        }else if(resp.msg){
                            $.success(resp.msg);
                        }else{
                            $.hidePreloader();
                        }
                        calculateFunctionValue($this.attr('submit_success'),[$this,resp],'');

                    }else{
                        $.error(resp.msg,function () {
                            if (resp.url) {
                                location.href=resp.url;
                            }
                        });
                    }
                });
            }
        }

        if($this.attr('href') != null){
            return false;
        }
    });

    $('.hclose').click(function(event) {
        $('.home-mask').animate({'top':'-110%'}, 400)
    });

    $('.homep-add,.sy-head-top .syadd').click(function(event) {
        $('.home-mask').animate({'top':'0%'}, 400)
    });
});
