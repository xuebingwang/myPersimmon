<?php
if(!function_exists('time_tran')){

    function time_tran($the_time){

        $now_time = time();
        $show_time = strtotime($the_time);
        $dur = $now_time - $show_time;

        switch (true){
            case $dur < 0:
                $str = '这家伙穿越到未来了';
                break;
            case $dur < 60:
                $str = '刚刚';
                break;
            case $dur < 3600:
                $str = floor($dur/60).'分钟前';
                break;
            case $dur < 86400:
                $str = floor($dur/3600).'小时前';
                break;
            case $dur < 86400*365:
                $dur = floor($dur/86400);
                if($dur > 31){
                    $str = floor($dur/30).'个月前';
                }else{
                    $str = $dur.'天前';
                }
                break;
            default :
                $str = floor($dur/(86400*365)).'年前';
        }

        return $dur < 0 ? $str : $str.'来过';
    }
}

if(!function_exists('is_login')){

    function is_login(){

        return !empty(session('member_auth'));
    }
}

if (!function_exists("current_is")) {
    /**
     * 判断路由
     * @return bool
     */
    function current_is($name)
    {
        $is = false;
//        $route = \Illuminate\Support\Facades\Route::current();
//        if ($route->getName() == $name) {
//            $is = true;
//        }
        return $is;
    }
}


if (!function_exists("cdn")) {
    /**
     * 拼接云储存的地址
     * @param $name
     * @param string $prot
     * @return string
     */
    function cdn($name, $prot = '')
    {
        $domains = config('filesystems.disks.qiniu.domains');
        $protocol = !empty($prot) ? $prot : config('filesystems.disks.qiniu.protocol');
        $url = sprintf("%s://%s/%s", 'http', $domains[$protocol], $name);
        return $url;
    }
}


if (!function_exists("bloginfo")) {
    /**
     * 读取动态配置
     * @param $name
     * @param bool $clear
     * @return string
     */
    function bloginfo($name, $clear = false)
    {
        $options = cache('options');
        if (empty($options) || $clear) {
            cache()->forget('options');
            $expiresAt = \Carbon\Carbon::now()->addMinutes(1440);
            $optionsList = \Models\Options::orderBy('id')->select('option_name', 'option_value')->get()->toArray();
            foreach ($optionsList as $key => $option) {
                $options[strtolower($option['option_name'])] = $option['option_value'];
            }
            cache(['options' => $options], $expiresAt);
        }
        return isset($options[$name]) ? $options[$name] : '';
    }
}


if (!function_exists('msubstr')) {
    /**
     * 字符串截取
     * @param           $str
     * @param int $start
     * @param           $length
     * @param string $charset
     * @param bool|true $suffix
     * @return string
     * @author Mr.Cong <i@cong5.net>
     */
    function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
    {
        if (function_exists("mb_substr")) {
            $slice = mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
            if (false === $slice) {
                $slice = '';
            }
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }
        return $suffix ? $slice . '...' : $slice;

    }
}


if (!function_exists("get_description")) {
    /**
     * 根据文章ID截取描述
     * @param $id
     * @param int $word
     * @return string
     * @author Mr.Cong <i@cong5.net>
     */
    function get_description($content, $word = 210)
    {
        if (empty($content)) {
            return '...';
        }
        $description = msubstr(strip_tags($content), 0, $word);
        return $description;
    }
}


if (!function_exists("transferMonth")) {
    /**
     * 英文月份解析
     * @param $zhDate
     * @return string
     */
    function transferMonth($zhDate)
    {
        $month = [
            '一月' => 'Jan',
            '二月' => 'Feb',
            '三月' => 'Mar',
            '四月' => 'Apr',
            '五月' => 'May',
            '六月' => 'Jun',
            '七月' => 'Jul',
            '八月' => 'Aug',
            '九月' => 'Sep',
            '十月' => 'Oct',
            '十一月' => 'Nov',
            '十二月' => 'Dec',
        ];
        $zhMonth = explode(' ', $zhDate);
        return sprintf("%s %s %s", $month[$zhMonth[0]], $zhMonth[1], $zhMonth[2]);
    }
}