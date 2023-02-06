<?php
require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 'on');

use GuzzleHttp\Client;

function changeToCTimestamp(int $time) {
    return ($time * 10000000) + 621355968000000000;
}

function changeToTimestamp($cTimestamp) {
    return date('Y-m-d H:i:s', ($cTimestamp - 621355968000000000)/10000000);
}

function get_date_range_x($type = 1) {
	// 今天
	$end = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
	switch ($type) {
		case 2: // 最近7天
			$start = mktime(0, 0, 0, date('m'), date('d') - 6, date('Y'));
			break;
		case 3: // 今天
			$start = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			break;
		case 4: // 昨天
			$start = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
			$end = mktime( 0, 0, 0, date('m'), date('d'), date('Y')) - 1;
			break;
		case 5: // 最近3个月
			$start = mktime(0, 0, 0, date('m') - 3, date('d'), date('Y'));
			break;
		case 6: // 最近6个月
			$start = mktime(0, 0, 0, date('m') - 6, date('d'), date('Y'));
			break;
		case 7: // 最近1年
			$start = mktime(0, 0, 0, date('m'), date('d'), date('Y') - 1);
			break;
		case 1:
		default: // 默认为最近30天
			$start = mktime(0, 0, 0, date('m'), date('d') - 29, date('Y'));
			break;
	}

	$range = array('start' => date("Y-m-d 00:00:00", $start), 'end' => date("Y-m-d H:i:s", $end));

	return $range;
}


class TaoUK51 {
    private $base;
    private $appkey;
    private $appsecret;

    public function __construct()
    {
        // 测试
        // $this->base = 'http://uatwebapi.51cpk.com';
        // $this->appkey = '227656';
        // $this->appsecret = '352ad97ca0e0cd8d6ee162006b240464';

        /******************************************************************/
        $this->base = 'https://webapi.51taouk.com';
        //$this->base = 'https://webapi.51parcel.com';
        $this->appkey = '227656';
        $this->appsecret = '578cfbd0a5d573ebb1efa6a8b162f93f';
        /**************************************************************** */
    }

    public function getInputedOrders(int $inputStart = 0, int $inputEnd = 0) {
        $params = [
            'InWarehourTimeStart' => changeToCTimestamp($inputStart),
            'InWarehourTimeEnd' => changeToCTimestamp($inputEnd),
            'OrderStatusId' => 9
        ];
        //dump($params);

        return $this->request('/api/OrderIntegration/SearchOrder', $params);
    }

    public function getShippedOrders(int $inputStart = 0, int $inputEnd = 0) {
        $params = [
            'InWarehourTimeStart' => changeToCTimestamp($inputStart),
            'InWarehourTimeEnd' => changeToCTimestamp($inputEnd),
            'OrderStatusId' => 29
        ];
        //dump($params);

        return $this->request('/api/OrderIntegration/SearchOrder', $params);
    }

    private function getPendingOrders(int $pendingStart = 0, int $pendingEnd = 0) {
        $params = [
            'CreatedTimeStart' => changeToCTimestamp($pendingStart),
            'CreatedTimeEnd' => changeToCTimestamp($pendingEnd),
            'OrderStatusId' => 0
        ];
        //dump($params);

        return $this->request('/api/OrderIntegration/SearchOrder', $params);
    }

    public function signSearchOrders() {
        $date = get_date_range_x(4);
        // 获取未预报的包裹（只对未预报包裹做签收）
        $pendingOrders = $this->getPendingOrders(strtotime($date['start']), strtotime($date['end']));
        dump($pendingOrders);
        $pendingOrders = array_filter($pendingOrders, function($pendingOrder) {
            return $pendingOrder->OrderReferenceNumber === 'HaitaoAdminInitialedOrder';
        });

        // 获取入库且不是未预报的包裹
        // 预报包裹的下一个状态就会是入库，所以只能用入库的包裹来作为签收的信息
        // 就了解未预报的虽然下一个状态也是入库，但是那边仓库的流程上是"没填写预报信息，仓库称重录入系统，生成HTO订单入库 ，然后客户补充商品信息，订单变为等候管理员操作，管理员操作后，订单入库"，从逻辑上，上面的代码已经做了签收动作了不用再再次做一次
        $inputedOrders = $this->getInputedOrders(strtotime($date['start']), strtotime($date['end']));
        dump($inputedOrders);
        $inputedOrders = array_filter($inputedOrders, function($inputedOrder) {
            return $inputedOrder->OrderReferenceNumber !== 'HaitaoAdminInitialedOrder';
        });

        $orders = array_merge($pendingOrders, $inputedOrders);

        return $orders;
    }

    public function searchOrder()
    {
        $path = '/api/OrderIntegration/SearchOrder';
        $params = [
            //'PaymentTimeStart' => changeToCTimestamp(strtotime('2021-03-28 00:00:00')),
            //'PaymentTimeEnd' => changeToCTimestamp(strtotime('2021-03-29 00:00:00')),
            // 'CreatedTimeStart' => changeToCTimestamp(strtotime('2021-04-26 00:00:00')),
            // 'CreatedTimeEnd' => changeToCTimestamp(strtotime('2021-04-26 23:59:59')),
            // 'OrderStatusId' => 0,
            //'InWarehourTimeStart' => changeToCtimestamp(strtotime('2021-07-20 00:00:00')),
            //'InWarehourTimeEnd' => changeToCtimestamp(strtotime('2021-07-20 23:59:59')),
            //'OrderStatusId' => 29,
            // 'ShippedTimeStart' => changeToCTimestamp(strtotime('2021-04-26 00:00:00')),
            // 'ShippedTimeEnd' => changeToCTimestamp(strtotime('2021-04-26 23:59:59')),
            // 'OrderStatusId' => 29,
            //'OrderReferenceNumber' => '2231986526',
            'OrderReference' => 'HTOCN0708016112676',//HTOCN0401015780926
        ];

        return $this->request($path, $params);
    }

    public function retrieveLabel()
    {
        $path = '/api/ShipmentIntegration/RetrieveLabel';

        $params = [
            'SearchText' => 'JD0002246892567291',
        ];

        $this->request($path, $params);
    }

    public function trackParcel()
    {
        $path = '/api/ShipmentIntegration/TrackParcel';

        $params = [
            'SearchText' => 'JD0002246892567291',
        ];

        $this->request($path, $params);
    }

    public function placeHaiTaoOrder()
    {
        $path = '/api/OrderIntegration/PlaceHaiTaoOrder';

        $params = [
            // AT123 HTOCN0317015603210
            // AT1234 HTOCN0322015603223
            'OrderReferenceNumber' => 'aaa',
            // PackageName	string
            // ShoppingWebsite	string
            // OverseaLogistic	string
            'OverseaTrackingNumber' => 'NY508358591GB122',
            // Notes	string
            //'OrderReference' => 'aa',
            'ShipFromName' => 'ldf',
            'ShipFromEmail' => 'ldf@gmail.com',
            'ShipFromPhone' => '67788111',
            'ShipFromCellPhone' => '67788111',
            'ShipFromAddress' => 'address aa',
            #'ShipFromAddress2' => 'address bb',
            #'ShipFromAddress3' => 'address cc',
            'ShipFromCity' => 'MC',
            'ShipFromProvince' => 'MU',
            'ShipFromPostalCode' => '411',
            'ShipFromCountry' => 'GB',
            'ShipToName' => 'llf',
            'ShipToAddress' => 'to address aa',
            'ShipToCity' => 'LONDON FC',
            'ShipToProvince' => 'HOT',
            'ShipToPostalCode' => '522',
            'ShipToAreaCode' => '',
            'ShipToProvinceId' => 0,
            'ShipToCountry' => 'FR',
            'ShipToIDCardType' => 1,
            'ShipToIDCardNumber' => '123',
            'ShipToEmail' => 'aab',
            'ShipToCellPhone' => '6666',
            // 'ShipToQQ' => '',
            // 'ShipToWechat' => '',
            // 'ShipToPhone' => '',
            'HaiTaoItems' => [
                [
                    'ItemWeight'	=> '3',
                    'Quantity'	=> 1,
                    'UnitPrice'		=> '0.2',
                    'ProductName'		=> 'product a'
                ],
                [
                    'ItemWeight'	=> '4',
                    'Quantity'	=> 2,
                    'UnitPrice'		=> '0.3',
                    'ProductName'		=> 'product b'
                ],
            ],
            //'AdditionalServices' => 1
        ];

        return $this->request($path, $params);
    }

    public function updateHaiTaoOrder()
    {
        $path = '/api/OrderIntegration/UpdateHaiTaoOrder';

        $params = [
            // AT123 HTOCN0317015603210
            // PackageName	string
            // ShoppingWebsite	string
            // OverseaLogistic	string
            // OverseaTrackingNumber	string
            // Notes	string
            // 修改这两个必填
            'OrderReferenceNumber' => 'HaitaoAdminInitialedOrder',
            'OrderReference' => 'HTOCN0201015599223',

            'ShipFromName' => 'ADI',
            'ShipFromEmail' => 'support@adiexpress.com',
            'ShipFromPhone' => '02033060554',
            'ShipFromCellPhone' => '07455006586',
            'ShipFromAddress' => 'Unit 2 Anchor Wharf  Yeo Street',
            'ShipFromCity' => 'City of London',
            'ShipFromProvince' => 'London',
            'ShipFromPostalCode' => 'E3 3QR',
            'ShipFromCountry' => 'GB',
            'ShipToName' => 'Mike1',
            'ShipToAddress' => 'dashilu1',
            'ShipToCountry' => '朝阳区',
            'ShipToCity' => '北京市',
            'ShipToProvince' => '北京市',
            'ShipToPostalCode' => '100001',
            'ShipToAreaCode' => '',
            'ShipToProvinceId' => 1,
            'ShipToCountry' => 'CN',
            'ShipToIDCardType' => 1,
            'ShipToIDCardNumber' => '1232',
            // 'ShipToQQ' => '',
            // 'ShipToWechat' => '',
            'ShipToEmail' => 'mick@gmail2',
            // 'ShipToPhone' => '',
            'ShipToCellPhone' => '77773',
            // 'HaiTaoItems' => [
            //     [
            //         'ItemWeight'	=> '3',
            //         'Quantity'	=> 1,
            //         'UnitPrice'		=> '0.2',
            //         'ProductName'		=> 'product a4'
            //     ],
            //     [
            //         'ItemWeight'	=> '4',
            //         'Quantity'	=> 2,
            //         'UnitPrice'		=> '0.3',
            //         'ProductName'		=> 'product b4'
            //     ],
        ];

        var_dump($this->request($path, $params));
    }


    public function processPayment()
    {
        $path = '/api/OrderIntegration/ProcessPayment';

        $params = [
            'OrderReference' => 'HTOCN0329015603339',
            'ServiceProviderId' => 12
        ];

        var_dump($this->request($path, $params));
    }
    private function request(string $path, array $params)
    {
        $client = new Client(['base_uri' => $this->base]);

        $json = json_encode($params);

        $sign = $this->sign($json);
        //echo $sign;

        $post = [
            'AppKey' => $this->appkey,
            'RequestString' => $json,
            'Sign' => $sign
        ];

        dump(json_encode($post));

        try {
            $response = $client->request(
                'POST',
                $path,
                [
                    'json' => $post,
                    'config' => [
                        'curl' => [
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_SSL_VERIFYHOST => false
                        ]
                    ]
                ]
            );

            $body = $response->getBody();

            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            return $data;
        } catch (GuzzleHttp\Exception\BadResponseException $th) {
            return [
                'code' => 402,
                'message' => $th->getMessage(),
                'data' => []
            ];
        }
    }

    private function sign(string $input)
    {
        //echo $input . $this->appsecret;
        return md5(($input . $this->appsecret));
    }

    // private function createClient():Client {
    //     $client = new \GuzzleHttp\Client(['base_uri' => $this->base]);

    //     return $client;
    // }
}
// dump(strtotime(date('-3 day')));
// dump(strtotime(date('yesterday')));
// exit;

$bar = new TaoUK51();
// $b = $bar->updateHaiTaoOrder();
// dump($b);
// $date = get_date_range_x(4);

// $a = $bar->getShippedOrders(strtotime($date['start']), strtotime($date['end']));
// dump($a);
// $date = get_date_range_x(4);

// $orders = $bar->searchOrder();
// var_dump($orders);


// $a = $bar->signSearchOrders();
// dump($a);

// $a = array_reduce($orders, function($carry, $order) {
//     $carry[$order->OrderReference] = [changeToTimestamp($order->InWarehouseDate), $order->HaiTaoShipment->Weight];
//     return $carry;
// }, []);

// dump($a);
//$bar->retrieveLabel();
//$bar->trackParcel();
dump($bar->placeHaiTaoOrder());
// $bar->updateHaiTaoOrder();
//$bar->processPayment();
//{"Success":false,"ErrorCode":"Exception","Message":"Order [HTOCN0329015603339] not exists!","AdditionalInfo":{},"StringList":[]}#
// $orderJson = '[{"OrderReference":"HTOCN0710011947869","ShipFromName":"51TAOUK","ShipFromEmail":"info@51parcel.com","ShipFromPhone":"02033060554","ShipFromCellPhone":"02033060554","ShipFromAddress":"51Parcel LTD","ShipFromAddress2":"Yeo Street","ShipFromAddress3":"City of London","ShipFromCity":"London","ShipFromProvince":"","ShipFromPostalCode":"E3 3QR","ShipFromCountry":"GB","ShipToName":"","ShipToAddress":"","ShipToCity":"","ShipToProvince":"","ShipToPostalCode":"","ShipToAreaCode":"","ShipToProvinceId":0,"ShipToCountry":"","ShipToIDCardType":1,"ShipToIDCardNumber":"","ShipToQQ":"","ShipToWechat":"","ShipToEmail":"","ShipToPhone":"","ShipToCellPhone":"","OverseaTrackingNumber":"nj760071391gb","OrderAmount":0.0,"HaiTaoItems":[{"ItemWeight":0.0000,"Quantity":1,"UnitPrice":35.00,"ProductName":"煤油打火机","UserComment":"","CategoryId":0,"SubCategoryId":0}],"AdditionalServices":[{"ServiceName":"仓储服务","ServiceCharge":348.08}],"HaiTaoShipment":null,"ShipmentQuotations":[{"ServiceProviderId":46,"ServiceProviderName":"杂货包税Mini","OrderChargableWeight":0.37,"ShippingPrice":15.720},{"ServiceProviderId":5,"ServiceProviderName":"比利时邮政(大陆)","OrderChargableWeight":0.37,"ShippingPrice":9.600},{"ServiceProviderId":11,"ServiceProviderName":"比利时邮政(香港)","OrderChargableWeight":0.37,"ShippingPrice":28.380},{"ServiceProviderId":12,"ServiceProviderName":"比利时邮政(台湾)","OrderChargableWeight":0.37,"ShippingPrice":19.090},{"ServiceProviderId":13,"ServiceProviderName":"比利时邮政(澳门)","OrderChargableWeight":0.37,"ShippingPrice":25.370},{"ServiceProviderId":38,"ServiceProviderName":"海淘专线","OrderChargableWeight":0.37,"ShippingPrice":11.200}],"OrderStatusId":9,"OrderStatus":"OrderShipmentReadyForPayment","OrderStatusName":"等候客户付款"}]';

// $order = json_decode($orderJson);

// dump($order);
//dump(changeToTimestamp(637547039990000000));
