<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    //new
    'zh_mobile'   => '手机号码格式不正确！',
    'captcha'   => '图形验证码不正确！',
    'verify_code'   => '手机短信验证码不正确!',

    'accepted' => ':attribute 必须接受。',
    'active_url' => ':attribute 不是一个有效的网址。',
    'after' => ':attribute 必须要晚于 :date。',
    'after_or_equal' => ':attribute 必须要等于 :date 或更晚。',
    'alpha' => ':attribute 只能由字母组成。',
    'alpha_dash' => ':attribute 只能由字母、数字和斜杠组成。',
    'alpha_num' => ':attribute 只能由字母和数字组成。',
    'array' => ':attribute 必须是一个数组。',
    'before' => ':attribute 必须要早于 :date。',
    'before_or_equal' => ':attribute 必须要等于 :date 或更早。',
    'between' => [
        'numeric' => ':attribute 必须介于 :min - :max 之间。',
        'file' => ':attribute 必须介于 :min - :max kb 之间。',
        'string' => ':attribute 必须介于 :min - :max 个字符之间。',
        'array' => ':attribute 必须只有 :min - :max 个单元。',
    ],
    'boolean' => ':attribute 必须为布尔值。',
    'confirmed' => ':attribute 两次输入不一致。',
    'date' => ':attribute 不是一个有效的日期。',
    'date_format' => ':attribute 的格式必须为 :format。',
    'different' => ':attribute 和 :other 必须不同。',
    'digits' => ':attribute 必须是 :digits 位的数字。',
    'digits_between' => ':attribute 必须是介于 :min 和 :max 位的数字。',
    'dimensions' => ':attribute图片尺寸不正确。',
    'distinct' => ':attribute已经存在。',
    'email' => ':attribute不是一个合法的邮箱。',
    'exists' => ':attribute不存在。',
    'file' => ':attribute必须是文件。',
    'filled' => ':attribute不能为空。',
    'image' => ':attribute 必须是图片。',
    'in' => '已选的属性 :attribute 非法。',
    'in_array' => ':attribute 没有在 :other 中。',
    'integer' => ':attribute 必须是整数。',
    'ip' => ':attribute 必须是有效的 IP 地址。',
    'json' => ':attribute 必须是正确的 JSON 格式。',
    'max' => [
        'numeric' => ':attribute 不能大于 :max。',
        'file' => ':attribute 不能大于 :max kb。',
        'string' => ':attribute 不能大于 :max 个字符。',
        'array' => ':attribute 最多只有 :max 个单元。',
    ],
    'mimes' => ':attribute 必须是一个 :values 类型的文件。',
    'mimetypes' => ':attribute 必须是一个 :values 类型的文件。',
    'min' => [
        'numeric' => ':attribute 必须大于等于 :min。',
        'file' => ':attribute 大小不能小于 :min kb。',
        'string' => ':attribute 至少为 :min 个字符。',
        'array' => ':attribute 至少有 :min 个单元。',
    ],
    'not_in' => '已选的属性 :attribute 非法。',
    'numeric' => ':attribute必须是一个数字。',
    'present' => ':attribute必须存在。',
    'regex' => ':attribute格式不正确。',
    'required' => ':attribute不能为空。',
    'required_if' => '当 :other 为 :value 时 :attribute不能为空。',
    'required_unless' => '当 :other 不为 :value 时 :attribute不能为空。',
    'required_with' => '当 :values 存在时 :attribute不能为空。',
    'required_with_all' => '当 :values 存在时 :attribute不能为空。',
    'required_without' => '当 :values 不存在时 :attribute不能为空。',
    'required_without_all' => '当 :values 都不存在时 :attribute不能为空。',
    'same' => ':attribute 和 :other 必须相同。',
    'size' => [
        'numeric' => ':attribute 大小必须为 :size。',
        'file' => ':attribute 大小必须为 :size kb。',
        'string' => ':attribute 必须是 :size 个字符。',
        'array' => ':attribute 必须为 :size 个单元。',
    ],
    'string' => ':attribute必须是一个字符串。',
    'timezone' => ':attribute必须是一个合法的时区值。',
    'unique' => ':attribute已经存在。',
    'uploaded' => ':attribute 上传失败。',
    'url' => ':attribute格式不正确。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'category_flag' => [
            'flag' => ':attribute 只允许英文或者拼音,横杠(-),下划线(_)的组合',
        ],
        'post_flag' => [
            'flag' => ':attribute 只允许英文或者拼音,横杠(-),下划线(_)的组合',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of 'email'. This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => '昵称',
        'username' => '用户名',
        'email' => '邮箱',
        'first_name' => '名',
        'last_name' => '姓',
        'password' => '登录密码',
        'password_confirmation' => '确认密码',
        'city' => '城市',
        'country' => '国家',
        'address' => '地址',
        'phone' => '电话',
        'mobile' => '手机号码',
        'age' => '年龄',
        'sex' => '性别',
        'gender' => '性别',
        'day' => '天',
        'month' => '月',
        'year' => '年',
        'hour' => '时',
        'minute' => '分',
        'second' => '秒',
        'title' => '标题',
        'content' => '内容',
        'description' => '描述',
        'excerpt' => '摘要',
        'date' => '日期',
        'time' => '时间',
        'available' => '可用的',
        'size' => '大小',
        'category_name' => '分类名称',
        'category_flag' => '分类别名',
        'tags_name' => '标签名称',
        'tags_flag' => '标签别名',
        'flag' => '文章别名',
        'post_id' => '文章ID',
        'category_id' => '文章分类',
        'markdown' => '文章内容',
        'url' => '网址',
        'site_name' => '网站名称',
        'keywords' => '关键词',
        'option_title' => '配置项说明',
        'option_name' => '配置项名称',

        //new
        'captcha'       => '图形验证码',
        'verify_code'       => '手机短信验证码',
        'domain'       => '个人域名',
        'birthday'       => '生日',
        'province_id'       => '省份',
        'city_id'       => '城市',
        'area_id'       => '区/县',
        'old'      => '旧密码',
        'new'      => '新密码',
        'confirm'  => '确认密码',
        'is_show_liked'      => '公开我赞过的内容',
        'is_show_collect'  => '公开我的藏品',
        'is_public'  => '是否公开',
        'album_name'  => '作品集名称',
        'work_name'  => '作品名称',
        'work_category_id'  => '作品分类',
        'size_h'  => '作品高度',
        'size_w'  => '作品宽度',
        'quality'  => '材质',
        'work_desc'  => '创作手记',
        'work_tags'  => '作品标签',
        'work_pics'  => '作品图片',
        'comment'  => '评论内容',

        'real_name'=>'真实姓名',
        'paper_num'=>'身份证号',
        'school_name'=>'毕业院校',
        'in_school_year'=>'入学年份',
        'out_school_year'=>'毕业年份',
        'id_pic'=>'身份证照片',
        'head_pic'=>'本人头像照片',

        'art_circle_pics'=>'艺术圈图片',
        'art_circle_desc'=>'此刻的想法',
        'art_circle_tags'=>'标签',

        'content_pics'=>'文章封面图',
        'msg_content'=>'留言内容',
    ],

];
