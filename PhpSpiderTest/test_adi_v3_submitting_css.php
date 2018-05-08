<?php
require_once __DIR__ . '/../vendor/autoload.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
/* Do NOT delete this comment */
/* 不要删除这段注释 */

/* use phpspider\core\requests;

$cookies = 'Hm_lvt_9f0b6e687f13d973156cc960cccc9a13=1524188328,1524464882,1524533751,1524620190; Hm_lpvt_9f0b6e687f13d973156cc960cccc9a13=1524647087; ci_session_v3=h5flfc1k3maith4fenret7top1t23qc4';
requests::set_cookies($cookies, 'adi-v3.dev');
$url = "http://adi-v3.dev/dashboard";
$html = requests::get($url);
echo $html;     // 可以看到登录后的页面，非常棒👍
exit;
*/


$configs = array(
    'name' => 'adi_v3_submitting_css选择器',
    //'tasknum' => 8,
    //爬虫爬取每个网页的时间间隔
    'interval' => 300,
    'log_show' => true,
    'domains' => array(
        'adi-v3.dev',
    ),
    //定义爬虫的入口链接, 爬虫从这些链接开始爬取,同时这些链接也是监控爬虫所要监控的链接
    'scan_urls' => array(
        'http://adi-v3.dev/package/lists\?type=submitting',
    ),
    // 定义列表页url的规则，这个是个列表页，提高获取每页内容的效率
    'list_url_regexes' => array(
        "http://adi-v3.dev/package/lists?type=submitting&page=\d+"
    ),
    //定义内容页url的规则，获取每页中特定内容页
    'content_url_regexes' => array(
        "http://adi-v3.dev/package/detail\?pid=\d+&type=submitting"
    ),
    /*'proxies' => array(
        'http://H784U84R444YABQD:57A8B0B743F9B4D2@proxy.abuyun.com:9010'
    ),*/
    'max_try' => 5,
    'export' => array(
        'type' => 'csv',
        'file' => './PhpSpiderTest/data/adi_v3_submitting.csv',
    ),
    // 以下字段中的内容都应该体现content_url_regexes这个配置中url对应的页面
    'fields' => array(
        array(
            'name' => "pid",
            //<div class="author clearfix"> 'selector' => "//div[contains(@class,'author')]//h2",
            'selector' => "body > div.main_wrap.clearfix > div.main_right > div.info_wrap > div.info_item.transfer_basic.clearfix > div.tb_left > p:nth-child(1)",
            'selector_type' => 'css',
            'required' => true,
        ),
        /*array(
            'name' => "article_author",
            'selector' => "div.author > a > h2",
            'selector_type' => 'css',
            'required' => true,
        ),*/
        //array(
            //'name' => "article_headimg",
            //'selector' => "//div.author > a:eq(0)",
            //'selector_type' => 'css',
            //'required' => true,
        //),
        array(
            'name' => "add_date",
            'selector' => "body > div.main_wrap.clearfix > div.main_right > div.info_wrap > div.info_item.transfer_basic.clearfix > div.tb_right > p:nth-child(3)",
            'selector_type' => 'css',
            'required' => true,
        ),
        //array(
            //'name' => "article_publish_time",
            //'selector' => "div.author > a > h2",  // 这里随便设置，on_extract_field回调里面会替换
            //'selector_type' => 'css',
            //'required' => true,
        //),
        /*array(
            'name' => "url",
            'selector' => "body > div.main_center > div.center_box",  // 这里随便设置，on_extract_field回调里面会替换
            'selector_type' => 'css',
            'required' => true,
        ),*/
        //array(
            //'name' => "depth",
            //'selector' => "div.author > a > h2",  // 这里随便设置，on_extract_field回调里面会替换
            //'selector_type' => 'css',
            //'required' => true,
        //),
    ),
);





$spider = new phpspider($configs);

/*$spider->on_handle_img = function($fieldname, $img)
{
    $regex = '/src="(https?:\/\/.*?)"/i';
    preg_match($regex, $img, $rs);
    if (!$rs)
    {
        return $img;
    }

    $url = $rs[1];
    $img = $url;

    //$pathinfo = pathinfo($url);
    //$fileext = $pathinfo['extension'];
    //if (strtolower($fileext) == 'jpeg')
    //{
        //$fileext = 'jpg';
    //}
    //// 以纳秒为单位生成随机数
    //$filename = uniqid().".".$fileext;
    //// 在data目录下生成图片
    //$filepath = PATH_ROOT."/images/{$filename}";
    //// 用系统自带的下载器wget下载
    //exec("wget -q {$url} -O {$filepath}");

    //// 替换成真是图片url
    //$img = str_replace($url, $filename, $img);
    return $img;
};*/

$spider->on_extract_field = function($fieldname, $data, $page)
{
    if ($fieldname == 'article_title')
    {
        $data = trim($data);
        if (strlen($data) > 1)
        {
            // 下面方法截取中文会有乱码
            //$data = substr($data, 0, 10)."...";
            $data = mb_substr($data, 0, 10, 'UTF-8')."...";
        }
    }
    /*elseif ($fieldname == 'article_publish_time')
    {
        // 用当前采集时间戳作为发布时间
        $data = time();
    }*/
    // 把当前内容页URL替换上面的field
    if ($fieldname == 'url')
    {
        $data = $page['url'];
    }/*
    // 把当前内容页depth替换上面的field
    elseif ($fieldname == 'depth')
    {
        $data = $page['request']['depth'];
    }*/
    return $data;
};

//$spider->start();

$spider->on_start = function($phpspider)
{
    $cookies = 'Hm_lvt_9f0b6e687f13d973156cc960cccc9a13=1524188328,1524464882,1524533751,1524620190; Hm_lpvt_9f0b6e687f13d973156cc960cccc9a13=1524650476; ci_session_v3=2riid1gfkbe6ms1vmsg0jf05g8qhvb3b';
    requests::set_cookies($cookies, 'adi-v3.dev');

};

$spider->start();
