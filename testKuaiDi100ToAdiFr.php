<?php

$invoke_url = 'http://adi-fr.dev/v1/gettime';

$access_key_id = 'dTYMNWlYZDZjYT0M';//'RYTmzTBYjjNlZ3xZ';//zMQGzU54NTZWmjzV
$access_key_secret = 'JYOjljTiZhTNTNhkzNAWNgN2yZTAFzW2YmMhTkYZZDYZzjBN';//'MNTBdNEOE2yZNNDRjZgYTMj0MOYxzhlYTIMZYAhMYBO2lDzj';//2NZ0ITWYO5Tc2MAUTIT2zkT2E2iIN4N3EkxYG0MNDVYYjlmx
$time = time();

/*$parcel = array(
    'parcel_weight' => 12,
    'total_amount' => 141111,
    //'insurance' => (int)1,
);
$sender = array(
    'last_name' => 'Chen',
    'first_name' => 'Deng',
    'address' => '2301 84th St',
    'zipcode' => '95721',
    'city' => '355444',
    'mobile_phone' => '21',
    //'country_code' => 'FR',
);
$receiver = array(
    'last_name' => 'zhou',
    'first_name' => 'ziping',
    'country_code' => 'CN',
    'address' => '84 BOULEVARD MASSENA',
    'zipcode' => '400021',
    'city' => 'chongqing',
    'mobile_phone' => '0760523960',
);
$products = array(
    array(
        'category_name' => '123',
        'qty' => 12,
        'weight' => 0.1,
        'price' => 1.176
        //"originCountry" => "CN"
    ),
);*/

$post_data = array(
    'access_key_id' => $access_key_id,
    'timestamp'     => $time,
);
ksort($post_data);

$signature_str = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);
$signature = md5($signature_str . '&access_key_secret=' . $access_key_secret);

$post_data['signature'] = $signature;

$post_json = json_encode($post_data, JSON_UNESCAPED_UNICODE);

$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json;charset=UTF-8'));
curl_setopt($ch, CURLOPT_URL, $invoke_url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);

// 执行
$output = curl_exec($ch);




// 释放
curl_close($ch);

var_dump($output);