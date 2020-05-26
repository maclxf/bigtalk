<?php



class DhlDemo{

    private $access_key_id;
    private $url;
    private $access_key_secret;
    public function __construct()
    {
        $this->access_key_id = "zMQGzU54NTZWmjzV";
        $this->access_key_secret  = "2NZ0ITWYO5Tc2MAUTIT2zkT2E2iIN4N3EkxYG0MNDVYYjlmx";
        $this->url = "http://api.edockey.top/v1/chronopost";
        //$this->url = "http://api.test.edockey.cn/v1/chronopost";
        // $this->url = "http://api.edockey.com/v1/dhl";
    }

    public function create_order(){

        //国际示例数据
        $data = [
            "other_data" => [
                // 1
                // 'action'        => 'recherche_point',

                // 2
                'order_no' => 'bt123456',
                // 'action'        => 'opening_order',

                // 3
                // 'action'        => 'tranck',
                // 'action'        => 'cancel',
                // 'tracking_no'   => 'XY503332836VF',
            ],
            "sender" => [
                "name" => "test_sender",
                "phone" => "18423832017",
                "zipcode" => "69100",
                "city" => "Villeurbanne",
                "address" => "10, Rue des Hayes Melines, BP 328 dsfasdaff dsfdsfsdafsdafds sdfsdafsaf 27403 LOUVIERS Cedex",
                "address" => "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz",
                "country_code" => "FR",
            ],
            "receiver" => [
                "name" => "test_receiver",
                "phone" => "18423832017",
                "zipcode" => "69003",
                "city" => "Lyon",
                "address" => "10, Rue des Hayes Melines, BP 328 sadfasdfsdafsdafdsfffffffffffffffffffffffffffffffffffff 27403 LOUVIERS Cedex",
                 "address" => "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz",
                "country_code" => "FR",
            ],
            "parcel" => [
                "weight" => "3",          //包裹重量
               "length" => 2,               //包裹长度
               "width" => 3,                //包裹宽度
               "height" => 4,               //包裹高度
                // "additional_insurance" => null,        //保险金额
//                "preferred_time" => "19002100",     //首选时间
//                "delivery_time_frame" => "19002100",//交货时间范围 19：00 - 21:00
//                "country_code_origin" => "DE",      //面单（详单）国家编码
                // "description" => "",            //面单（详单）介绍
//                "additional_fee" => 4,              //面单（详单）附加费
//                "terms_of_trade" => "DDU",          //贸易条件
//                "day_off_delivery" => "1663505552", //交货时间 时间戳
                // "customs_value" => 10,               //面单（详单）包裹价值
            ],
            "products" => [
                [
                    "name" => "qq123",
                    "quantity" => "1",
                    "net_weight" => "1",
                    // "gross_weight" => "1",
                    "price" => "1.01",
                ]
            ]
        ];

        //欧盟示例数据
       /* $data = [
            "sender" => [
                "name" => "test_sender",
                "phone" => "18423832017",
                "email" => "2529395230@qq.com",
                "street_name" => "Sträßchensweg",
                "street_number" => "10",
                "zip" => "53113",
                "city" => "Bonn",
                "country" => "Deutschland",
                "country_iso_code" => "DE",
            ],
            "receiver" => [
                "name" => "test_receiver",
                "phone" => "18423832017",
                "email" => "2529395230@qq.com",
                "street_name" => "Weyermannsstrasse",
                "street_number" => "12",
                "zip1" => "75013",
                "zip" => "3008",
                "city" => "Bern",
                "country" => "Schweiz",
                "country_iso_code" => "CH",
            ],
            "parcel" => [
                "parcel_weight" => "12.2",          //包裹重量
//                "parcel_length" => 2,               //包裹长度
//                "parcel_width" => 3,                //包裹宽度
//                "parcel_height" => 4,               //包裹高度
                "additional_insurance" => null,        //保险金额
//                "preferred_time" => "19002100",     //首选时间
//                "delivery_time_frame" => "19002100",//交货时间范围 19：00 - 21:00
//                "country_code_origin" => "DE",      //面单（详单）国家编码
                "description" => "",            //面单（详单）介绍
//                "additional_fee" => 4,              //面单（详单）附加费
//                "terms_of_trade" => "DDU",          //贸易条件  欧盟产品必填
//                "day_off_delivery" => "1663505552", //交货时间 时间戳
                "customs_value" => 111,               //面单（详单）包裹价值
            ],
            "products" => [
                [
                    "category_name" => "qq",
                    "qty" => "1",
                    "weight" => "1.01",
                    "price" => "1.01",
                ]
            ]
        ];*/



//        $data = json_decode($data_json,true);
//print_r($data);die;
        $post_data = array(
            'access_key_id' => $this->access_key_id,
            'timestamp'     => time(),
            'parcel'        => $data['parcel'] ?? null,
            'sender'        => $data['sender'],
            'receiver'      => $data['receiver'],
            'products'      => $data['products'] ?? null,
            'other_data'    => $data['other_data'] ?? null
        );

        // 对参数进行A-Z自然排序
        ksort($post_data);
        $signature_str = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);
        $signature = md5($signature_str . '&access_key_secret=' . $this->access_key_secret);
        $signature_str = str_replace("+", "%20", $signature_str);

        $post_data["signature"] = $signature;
        return $this->curl_post($this->url, $post_data);
    }

    /**
     * 调用api接口
     * @author libin 2018-01-25
     * @param  string $url    api地址
     * @param  array $param  请求数据
     * @return json         访问结果
     */
    public function curl_post($url, $param) {
        $params = json_encode($param);
        $ch = curl_init();

        /*$header[] = "Accept: application/json";
        $header[] = "Accept-Encoding: gzip";
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt($ch,CURLOPT_ENCODING , "gzip");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');*/

        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //把访问返回的结果复制给变量
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json;charset=UTF-8'));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }

}
$demo =new DhlDemo();
$res = $demo->create_order();
if(is_string($res)){
    print_r($res);
}else{
    print_r(json_decode($res, true));
}


