/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 58);
/******/ })
/************************************************************************/
/******/ ({

/***/ 10:
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ }),

/***/ 12:
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {/**
 * Created by xuebingwang on 2017/6/8.
 */

/* global $:true */
+function ($) {
    "use strict";

    $.pic_upload = function (selector, callback) {

        var pic_upload = function pic_upload() {
            // you can ues 'onchange' here to uplpad automatically after select a file
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

            fileReader.onload = function (e) {

                // console.log("read chunk nr", currentChunk + 1, "of", chunks);
                spark.appendBinary(e.target.result); // append binary string
                currentChunk++;

                if (currentChunk < chunks) {
                    loadNext();
                } else {
                    //                console.info("computed hash", spark.end()); // compute hash
                    // if (!file_name.toLowerCase().match(/\.(jpg|jpeg|png|gif)$/)) {
                    //     alert('上传的图片类型不正确!');
                    //     return false;
                    // }

                    var file_name = spark.end() + $this.val().match(/\.?[^.\/]+$/);

                    new FormData();
                    var data = new FormData();

                    data.append('token', cat.upload_token);
                    data.append('key', file_name);
                    data.append('file', file);

                    $.ajax({
                        url: 'http://up-z2.qiniu.com/', // Different bucket zone has different upload url, you can get right url by the browser error massage when uploading a file with wrong upload url.
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        xhr: function xhr() {
                            var myXhr = $.ajaxSettings.xhr();
                            if (myXhr.upload) {
                                myXhr.upload.addEventListener('progress', function (e) {
                                    // console.log(e);
                                    if (e.lengthComputable) {
                                        var percent = e.loaded / e.total * 100;
                                        console.info('上传：' + e.loaded + "/" + e.total + " bytes. " + percent.toFixed(2) + "%");
                                    }
                                }, false);
                            }
                            return myXhr;
                        },
                        success: function success(res) {
                            callback.apply(file, [res, $this]);
                        },
                        error: function error(res) {
                            console.log("失败:" + JSON.stringify(res));
                            console.error('上传失败：' + res.responseText);
                        }
                    });
                }
            };

            return false;
        };

        if (cat.upload_token == null) {

            $.get('/api/upload_token', function (resp) {
                cat.upload_token = resp.upload_token;
                // $(selector).on('change',pic_upload);
                $(document).on('change', selector, pic_upload);
            }, 'json');
        } else {

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
var calculateFunctionValue = function calculateFunctionValue(func, args, defaultValue) {
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

String.prototype.len = function () {
    return this.replace(/[^\x00-\xff]/g, "__").length;
};

$(function () {
    function ajax_post(url, data) {
        var $this = $(this);
        $.showPreloader();

        data.push({ name: '_token', value: cat.csrf_token });

        $.post(url, data, function (resp) {
            if (resp.status == '0') {

                if (resp.url != '' && resp.msg == '') {
                    //返回url不为空并且消息为空
                    window.location = resp.url;
                } else if (resp.msg != '' && resp.url != null && resp.url != '') {
                    //返回信息与url都不为空
                    $.success(resp.msg, function () {
                        window.location = resp.url;
                    });
                } else if (resp.msg != '') {

                    //返回消息为空
                    $.success(resp.msg, function () {
                        if ($this.hasClass('refresh')) {

                            window.location.href = window.location.href;
                        }
                    });
                } else if (resp.msg == '' && resp.url == '') {
                    //返回信息与url都为空
                    if ($this.hasClass('refresh')) {

                        window.location.href = window.location.href;
                    } else {

                        $.hidePreloader();
                    }
                }
                calculateFunctionValue($this.attr('submit_success'), [$this, resp], '');
            } else {

                if (resp.url == null || resp.url == '') {
                    $.error(resp.msg, function () {
                        calculateFunctionValue($this.attr('fail'), [$this, resp], '');
                    });
                } else {
                    $.error(resp.msg, function () {
                        window.location = resp.url;
                    });
                }
            }
        }, 'json').always(function () {
            // $.hidePreloader();
        });
    }

    $(document).on('submit', '.ajax-form', function () {
        var $this = $(this);

        var flag = calculateFunctionValue($this.attr('before_submit'), [$this], '');
        if (typeof flag == 'boolean' && !flag) {
            return false;
        }
        if ($this.hasClass('confirm')) {

            var _this = this;
            var index = $.confirm($this.data('msg') || '您确认提交请求？', function () {
                ajax_post.apply(_this, [_this.action, $this.serializeArray()]);
            });
        } else {
            ajax_post.apply(this, [this.action, $this.serializeArray()]);
        }

        return false;
    });

    $(document).on('click', '.ajax-get', function () {
        var target;
        var $this = $(this);
        var flag = calculateFunctionValue($this.attr('before'), [$this], '');
        if (typeof flag == 'boolean' && !flag) {
            return false;
        }

        if ($this.hasClass('confirm')) {
            $.confirm($this.data('msg') || '确认要执行该操作吗？', $this.data('title') || '提示', function () {
                ajax_get();
            });
            return false;
        } else {
            ajax_get();
        }

        function ajax_get() {
            if ((target = $this.attr('href')) || (target = $this.attr('url'))) {
                $.showPreloader();
                $.get(target, function (resp) {
                    if (resp.status == '0') {

                        if (resp.url && $this.hasClass('no-refresh')) {
                            $this.attr('url', resp.url);
                        } else if (resp.url) {
                            if (resp.url == 'refresh') {
                                $.success(resp.msg, function () {
                                    window.location = window.location;
                                });
                            } else if (!$this.hasClass('no-refresh')) {
                                $.success(resp.msg, function () {
                                    location.href = resp.url;
                                });
                            }
                        } else if (resp.msg) {
                            $.success(resp.msg);
                        } else {
                            $.hidePreloader();
                        }
                        calculateFunctionValue($this.attr('submit_success'), [$this, resp], '');
                    } else {
                        $.error(resp.msg, function () {
                            if (resp.url) {
                                location.href = resp.url;
                            }
                        });
                    }
                });
            }
        }

        if ($this.attr('href') != null) {
            return false;
        }
    });

    $('.hclose').click(function (event) {
        $('.home-mask').animate({ 'top': '-110%' }, 400);
    });

    $('.homep-add,.sy-head-top .syadd').click(function (event) {
        $('.home-mask').animate({ 'top': '0%' }, 400);
    });
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(10)))

/***/ }),

/***/ 13:
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {/*
 * send verify sms
 *---------------------------
 * top lan <toplan710@gmail.com>
 * https://github.com/toplan/laravel-sms
 * --------------------------
 * Date 2015/06/08
 */

$(function () {
    $.fn.sms = function (options) {
        var self = this;
        var btnOriginContent, timeId;
        var opts = $.extend($.fn.sms.defaults, options);
        self.on('click', function (e) {
            btnOriginContent = self.html() || self.val() || '';
            changeBtn(opts.language.sending, true);
            send();
        });

        function send() {

            var url = getUrl();
            var requestData = getRequestData();
            $.ajax({
                url: url,
                type: 'post',
                data: requestData,
                success: function success(data) {
                    opts.notify.call(null, data);
                    if (data.success) {
                        timer(opts.interval);
                    } else {
                        changeBtn(btnOriginContent, false);
                    }
                },
                error: function error(xhr, type) {
                    changeBtn(btnOriginContent, false);
                    opts.notify.call(null, { success: false, message: opts.language.failed, type: 'request_failed' });
                },
                dataType: 'json'
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
                timeId = setTimeout(function () {
                    clearTimeout(timeId);
                    changeBtn(btnText.replace('{{seconds}}', seconds-- + ''), true);
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
        token: null,
        interval: 60,
        voice: false,
        domain: null,
        prefix: 'laravel-sms',
        requestData: null,
        notify: function notify(data) {
            if (data.success) {
                $.success(data.message);
            } else {
                $.error(data.message);
            }
        },
        language: {
            sending: '短信发送中...',
            failed: '请求失败，请重试',
            resendable: '{{seconds}} 秒后再次发送'
        }
    };

    $('#reg-send-sms').sms({
        //laravel csrf token
        token: cat.csrf_token,
        //请求间隔时间
        interval: 60,
        prefix: cat.sms_route_prefix,
        //请求参数
        requestData: {
            //手机号
            mobile: function mobile() {
                return $('input[name=mobile]').val();
            },
            captcha: function captcha() {
                return $('input[name=captcha]').val();
            },
            //手机号的检测规则
            mobile_rule: 'check_mobile_unique',
            captcha_rule: 'captcha'
        }
    });

    $('.send-sms').sms({
        //laravel csrf token
        token: cat.csrf_token,
        //请求间隔时间
        interval: 60,
        prefix: cat.sms_route_prefix,
        //请求参数
        requestData: {
            //手机号
            mobile: function mobile() {
                return $('input[name=mobile]').val();
            },
            captcha: function captcha() {
                return $('input[name=captcha]').val();
            },
            //手机号的检测规则
            captcha_rule: 'captcha'
        }
    });

    $('img.btn-fresh').each(function () {
        $(this).data('src', $('img.btn-fresh').attr('src')).click(function (ev) {
            var $this = $(this),
                src = $this.data('src');
            $this.attr('src', src + Math.random());
            return false;
        });
    });
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(10)))

/***/ }),

/***/ 58:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(12);
module.exports = __webpack_require__(13);


/***/ })

/******/ });