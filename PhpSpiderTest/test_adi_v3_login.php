<?php

require_once __DIR__ . '/../vendor/autoload.php';
use phpspider\core\requests;

// 登录请求url
//$login_url = "http://adi-v3.dev";
//// 提交的参数
//$params = array(
//    "a_email" => "46905313@qq.com",
//    "a_pswd"  => "111111",
//);

// 发送登录请求
//requests::post($login_url, $params);
// 登录成功后本框架会把Cookie保存到www.waduanzi.com域名下，我们可以看看是否是已经收集到Cookie了
$cookies = 'Hm_lvt_9f0b6e687f13d973156cc960cccc9a13=1524188328,1524464882,1524533751,1524620190; Hm_lpvt_9f0b6e687f13d973156cc960cccc9a13=1524647087; ci_session_v3=h5flfc1k3maith4fenret7top1t23qc4';
print_r($cookies);  // 可以看到已经输出Cookie数组结构
requests::set_cookies($cookies, 'adi-v3.dev');

// requests对象自动收集Cookie，访问这个域名下的URL会自动带上
// 接下来我们来访问一个需要登录后才能看到的页面
$url = "http://adi-v3.dev/dashboard";
$html = requests::get($url);
echo $html;     // 可以看到登录后的页面，非常棒👍