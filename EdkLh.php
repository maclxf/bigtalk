<?php
function invoke_lh() {
        $invoke_url = 'http://api.edockey.top/v1/lhcc_daifa';

        $access_key_id = 'zMQGzU54NTZWmjzV';//'RYTmzTBYjjNlZ3xZ';//zMQGzU54NTZWmjzV
        $access_key_secret = '2NZ0ITWYO5Tc2MAUTIT2zkT2E2iIN4N3EkxYG0MNDVYYjlmx';//'MNTBdNEOE2yZNNDRjZgYTMj0MOYxzhlYTIMZYAhMYBO2lDzj';//2NZ0ITWYO5Tc2MAUTIT2zkT2E2iIN4N3EkxYG0MNDVYYjlmx
        $time = time();

        $parcel = array(
            'order_no' => 'AT11231231231',
            'total_weight' => '3.4',
            //'insurance' => (int)1,
        );
        $sender = array(
            'name' => 'Handsome boy',
            'phone' => '111122333',
            'country_code' => 'FR',
            //'province' => '',
            'city' => 'pairs',
            'district' => 'pairs',
            'address' => 'aabbcc',
            //'zipcode' => '',
        );
        $receiver = array(
            'name' => 'cool girl',
            'phone' => '666777888',
            'country_code' => 'CN',
            'province' => '重庆',
            'city' => '重庆',
            'district' => '渝北',
            'address' => 'cccddd',
            'zipcode' => '677881',
            'idcard' => '442000198210021767',
        );
        $products = array(
            [
                'specification' => '100',
                'name' => '奶粉',
                'brand' => '咖喱呀',
                'count' => '1',
                'price' => '621',
                'item_total_weight' => '1.7',
                'unit' => '罐',
                //'currency' => 'ean123',
                'post_tax_num' => '00011000',
            ]
        );

        $post_data = array(
            'access_key_id' => $access_key_id,
            'timestamp'     => $time,
            'parcel'        => $parcel,
            'sender'        => $sender,
            'receiver'      => $receiver,
            'products'      => $products
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
    }

    invoke_lh();