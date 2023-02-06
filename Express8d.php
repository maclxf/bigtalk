<?php
require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

class Express8d {
    private $base;
    private $memberId;
    private $warehouseId;
    private $warehouseName;

    public function __construct() {
        $this->base = 'https://api.8dexpress.com/8dapi/';
        $this->memberId = 'A4F7';
        // $this->base = 'http://203.2.160.222:8082/8dapi/';
        // $this->memberId = '4A7B';
        $this->warehouseId = '01';
        $this->warehouseName = '俄勒冈州仓库';
    }

    public function getDeclareCategoryList() {
        $client = $this->createClient();
        try {
            $response = $client->request('GET', 'WayBill/GetDeclareCategoryList');

            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump(json_decode($data->data));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

    }

    public function getDeclareProductorList($categroyId) {
        $client = $this->createClient();
        try {
            $response = $client->request(
                'GET',
                'WayBill/GetDeclareProductorList',
                ['query' => ['goodCategoryID' => $categroyId]]
            );

            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump($data);
            dump(json_decode($data->data));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function getUserAddressList() {
        $client = $this->createClient();
        try {
            $response = $client->request(
                'GET',
                'User/GetUserAddressList',
                ['query' => ['memberID' => $this->memberId,'countryType' => 1]]
            );

            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump($data);
            dump(json_decode($data->data));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function getUserWarehouseList() {
        $client = $this->createClient();
        try {
            $response = $client->request(
                'GET',
                'User/GetUserWarehouseList',
                ['query' => ['memberID' => $this->memberId]]
            );

            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump($data);
            dump(json_decode($data->data));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function getUserTransportPortList() {
        $client = $this->createClient();
        try {
            $response = $client->request(
                'GET',
                'User/GetUserTransportPortList',
                ['query' => ['memberID' => $this->memberId,'houseID' => '01']]
            );

            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump($data);
            dump(json_decode($data->data));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function searchWarehouseWarrantInfoList() {
        $client = $this->createClient();
        try {
            $response = $client->request(
                'POST',
                'WarehouseWarrant/SearchWarehouseWarrantInfoList',
                ['form_params' => ['memberID' => $this->memberId, 'searchKeyWords' => '',  'page' => 1, 'pageSize' => 999]]
            );



            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            $packages = json_decode($data->list);
            dump($packages);

            // 格式化返回的时间 /Date(1610529502057+0800)/ => 2021-01-13 17:18:22
            $packages = array_map(function($package) {

                $timeString = trim($package->stockInTime, '/');
                // echo $timeString . '<br>';
                // //Date(1608801602000+0800)
                $timeString = strstr($timeString, '+', true);
                // echo $timeString . '<br>';
                $timeString = strstr($timeString, '(');
                // echo trim($timeString, '(') . '<br>';
                $timeString = trim($timeString, '(');
                $stockInDate = '';
                if ($timeString) {
                    $stockInDate = date('Y-m-d H:i:s', ($timeString / 1000));
                }

                $package->stockInDate = $stockInDate;

                return $package;
            }, $packages);

            // 3今天  4昨天
            $yesterday = [
                "start" => "2022-08-28 00:00:00",
                "end" => "2022-08-28 23:59:59"
            ];
            $houseId = $this->warehouseId;
            // 过滤出满足条件的订单数据
            $packages = array_filter($packages, function($package) use($yesterday, $houseId) {
                if (!$package->stockInDate) {
                    echo 1;
                    return false;
                }

                if ($package->warehouseID != $houseId) {
                    echo 2;
                    return false;
                }

                //包裹状态：2待确认、3已确认、4处理中(验货)、5处理中(拆箱)、6处理中(合箱)、15处理中(特殊服务)、16、处理中(代付款)
                // 待确认, 已确认表明仓库已收到货了
                if (!in_array($package->status, [2, 3])) {
                    // echo 3;
                    return false;
                }


                // if (in_array($package->trackingNumber, ['9400108205498957086928'])) {
                //     echo '<br>';
                //     echo $package->trackingNumber . '<br>';
                //     echo $package->stockInDate . '<br>';
                //     echo $yesterday['start'] . '<br>';
                //     echo $yesterday['end'];
                // }
                if (date_compare($package->stockInDate, $yesterday['start']) == -1 || date_compare($package->stockInDate, $yesterday['end']) == 1) {
                    // echo $package->trackingNumber . '<br>';
                    return false;
                }

                return true;
            });

            dump($packages);

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function createWayBillInfo() {
        $client = $this->createClient();
        // // //$client = new \GuzzleHttp\Client();
        $a0 = [
            [
                // 'goodUUID' => '111222',
                'goodCategoryCode' => '13',
                'goodCategoryName'  => '计算机3C产品',
                'goodDeclareCode'  => '192',
                'goodDeclareName'  => 'Apple TV',
                'goodBrand'  => 'Apple',
                'goodSpec'  => '高级电视',
                'goodNum'  => '1',
                'goodPrice'  => '998',
                // 'isAllowModify' => '',
                'goodImgURL'  => '',
                //'currency'=> 'UCD'
            ],
            [
                // 'goodUUID' => '3333666',
                'goodCategoryCode' => '17',
                'goodCategoryName'  => '乐器音乐',
                'goodDeclareCode'  => '285',
                'goodDeclareName'  => '长笛',
                'goodBrand'  => 'wood',
                'goodSpec'  => '音乐器材',
                'goodNum'  => '1',
                'goodPrice'  => '688',
                // 'isAllowModify' => '',
                'goodImgURL'  => '',
                //"currency"=> "UCD"
            ]
            ];
        $a = json_encode($a0, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_LINE_TERMINATORS);
        // echo "<pre>$a</pre>";
        // exit();
        try {
            $response = $client->request(
                "POST",
                'WayBill/AddAndUpdateWayBillInfo',
                //'http://api.edockey.top/v1/sto_daifa',
                [
                    // 'headers' => [
                    //     'Content-Type' => 'multipart/form-data'
                    // ],
                    // 'multipart' => [
                    //     [
                    //         'name' => 'memberID',
                    //         'contents' => $this->memberId
                    //     ],
                    //     [
                    //         'name' => 'wbID',
                    //         'contents' => ''
                    //     ],
                    //     [
                    //         'name' => 'wwID',
                    //         'contents' => 'WW2011040100040'
                    //     ],
                    //     [
                    //         'name' => 'transportModeCode',
                    //         'contents' => '24'
                    //     ],
                    //     [
                    //         'name' => 'transportModeName',
                    //         'contents'=> 'B大包裹专线'
                    //     ],
                    //     [
                    //         'name' => 'productList',
                    //         'contents' => $a,
                    //         'headers'  => ['Content-Type' => 'application/json']
                    //     ]
                    // ],
                    'form_params' => [
                        'memberID' => $this->memberId,
                        'wbID' => '',
                        'wwID' => 'WW2012140100033',
                        'isNeedBuyInsurance' => 1,
                        'transportModeCode' => '24',
                        'transportModeName' => 'B大包裹专线',
                        'addressID' => '',
                        'receiveName' => '卡列红',
                        'receivePhone' => '13399112',
                        'receiveCountryName' => '中国',
                        'receiveStateName' => '贵州省',
                        'receiveCityName' => '贵阳市',
                        'receiveDistrictName' => '贵得很区',
                        'receiveDetailAddress' => '9911-1',
                        'receiveZipCode' => '66221',
                        'receiveIDNumber' => '662216622166221123',
                        'wayBillAttID' => '',
                        // 'productList' => '[{"goodDeclareName":"Apple TV","goodDeclareCode":192,"goodCategoryName":"计算机3C产品","goodCategoryCode":13,"goodBrand":"Apple","goodSpec":"高级点事","goodNum":1,"goodPrice":998,"goodImgURL":""},{"goodDeclareName":"长笛","goodDeclareCode":285,"goodCategoryName":"乐器音乐","goodCategoryCode":17,"goodBrand":"wood","goodSpec":"音乐器材","goodNum":1,"goodPrice":688,"goodImgURL":""}]'
                        // 'productList' => '[{"goodDeclareName":"Apple TV","goodDeclareCode":192,"goodCategoryName":"计算机3C产品","goodCategoryCode":13,"goodBrand":"Apple","goodSpec":"高级点事","goodNum":1,"goodPrice":998,"goodImgURL":""},{"goodDeclareName":"长笛","goodDeclareCode":285,"goodCategoryName":"乐器音乐","goodCategoryCode":17,"goodBrand":"wood","goodSpec":"音乐器材","goodNum":1,"goodPrice":688,"goodImgURL":""}]'
                        'productList' => $a
                    ],
                    'debug' => true,
                    'http_errors' => false,
                ]
            );

            //echo $response->getStatusCode();
            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump($data);
            dump(json_decode($data->data));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }



        // $ch = curl_init();

        // $timeout = 5;
        // curl_setopt($ch, CURLOPT_URL, 'http://203.2.160.222:8082/8dapi/WayBill/AddAndUpdateWayBillInfo');
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // //把访问返回的结果复制给变量
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, [
        //                     'memberID' => $this->memberId,
        //                     'wbID' => '',
        //                     'wwID' => 'WW2011040100040',
        //                     'isNeedBuyInsurance' => 1,
        //                     'transportModeCode' => '24',
        //                     'transportModeName' => 'B大包裹专线',
        //                     'addressID' => 'd2a6e1ea-ddc5-45e3-9658-f40e1dd6bc6b',
        //                     'wayBillAttID' => '',
        //                     'productList' => '[{"goodDeclareName":"Apple TV","goodDeclareCode":192,"goodCategoryName":"计算机3C产品","goodCategoryCode":13,"goodBrand":"Apple","goodSpec":"高级点事","goodNum":1,"goodPrice":998,"goodImgURL":""},{"goodDeclareName":"长笛","goodDeclareCode":285,"goodCategoryName":"乐器音乐","goodCategoryCode":17,"goodBrand":"wood","goodSpec":"音乐器材","goodNum":1,"goodPrice":688,"goodImgURL":""}]'
        //                 ]);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:multipart/form-data'));
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        // $file_contents = curl_exec($ch);
        // curl_close($ch);
        // echo $file_contents;

    }

    public function createWarehouseForecast() {
        //$client = new \GuzzleHttp\Client();
        $client = $this->createClient();
        try {
            $response = $client->request(
                'POST',
                'WarehouseWarrant/WarehouseForecastCreate',
                //'http://api.edockey.top/v1/sto_daifa',
                ['form_params' => [
                        'memberID' => $this->memberId,
                        'warehouseID' => $this->warehouseId,
                        'warehouseName' => $this->warehouseName,
                        'trackingNumber' => 'NY508358591GB',
                        'wayBillContent' => '毛衣'
                    ]
                ]
            );


            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump($data);
            dump(json_decode($data->data));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function searchWayBillInfoList() {
        $client = $this->createClient();
        try {
            $response = $client->request(
                'POST',
                'WayBill/SearchWayBillInfoList',
                [
                    'form_params' => [
                        //'searchKeyWords' => 'WW2104290101104|WW2110050101258|WW2108070113627|WW2110150103580|WW2109110111445|WW2110190100582|WW2110150111558|WW2110130107046|WW2110190102887|WW2110190101126|WW2110230116146|WW2110230114025|WW2110230114156|WW2110260104288|WW2110160111698|WW2110300114698|WW2110280108415|WW2111030102180|WW2110290111668|WW2111020100685|WW2111020100978|WW2111040109246|WW2111040107216|WW2111050112006|WW2111090105515|WW2111090105796|WW2111090105497|WW2111100107148|WW2111080100167|WW2111090106817|WW2111130115298|WW2111170105668|WW2111180107485|WW2111170105706|WW2111180107066|WW2111190110085|WW2111230103727|WW2111300105801|WW2112030106603|WW2111230105168|WW2111230105175|WW2111240107236|WW2112040106941|WW2112040106982|WW2111270102717|WW2112040106961|WW2112040107321|WW2112040107332|WW2110230113995|WW2111290104062|WW2111290104050|WW2111290104073|WW2110130102356|WW2111170106688|WW2111200111855|WW2109080101077|WW2109100109376|WW2111250108607|WW2111020103587|WW2111290105291|WW2111300107228|WW2111300106567|WW2111300105247|WW2111300107505|WW2112060108832|WW2111300102148|WW2112060108842|WW2112060108933|WW2111300103738|WW2112010108087|WW2112010109556|WW2112010110266|WW2111230100666|WW2112010110417|WW2112010110326|WW2112010108496|WW2112010109825|WW2112020114375|WW2112020114505|WW2112020112445|WW2109230106727|WW2112110113273|WW2112010111398|WW2112020114057|WW2112020114647|WW2112030118078|WW2112200100352|WW2111300101218|WW2112030116776|WW2112020113738|WW2112030115628|WW2112040121918|WW2112150101182|WW2112020114047|WW2111230103827|WW2112030117597|WW2112020112187|WW2112020112038|WW2112150101582|WW2112210100563|WW2112150101561|WW2112220100632|WW2112020114148|WW2112150101553|WW2112220100643|WW2111270101296|WW2111270103987|WW2111300101936|WW2112030117377|WW2112040122177|WW2112150101360|WW2112060100086|WW2112060109303|WW2112060109310|WW2112150101572|WW2112150101672|WW2112150101831|WW2112070104516|WW2111300105627|WW2111270100697|WW2112070103615|WW2112070105016|WW2112070104926|WW2111300106785|WW2112070101268|WW2112040121537|WW2112070107407|WW2112220100660|WW2112070101787|WW2112090112387|WW2112090109266|WW2112220100652|WW2112090110467|WW2112040119336|WW2112090112017|WW2112090112418|WW2112090114416|WW2112040121026|WW2112090109096|WW2112090109667|WW2112090114976|WW2112100110873|WW2112100110883|WW2112220100690|WW2112090108966|WW2112090112006|WW2112090108015|WW2112090109996|WW2112090109935|WW2112100110891|WW2112100110900|WW2112100111282|WW2112220100872|WW2112090112297|WW2112030117046|WW2111270101356|WW2112010108976|WW2112090112027|WW2112060108561|WW2112220101023|WW2112220100731|WW2112110119377|WW2112110121938|WW2112110120698|WW2112110121768|WW2112030116507|WW2110010109957|WW2112090111146|WW2112090109747|WW2112110117487|WW2112100110720|WW2112100110730|WW2112100110743|WW2112100116485|WW2112220100893|WW2112110121275|WW2112090112186|WW2112220101103|WW2111300105146|WW2112040122208|WW2112090110448|WW2112030118668|WW2112040122318|WW2112020113637|WW2112110122017|WW2112090116176|WW2112110112062|WW2112110112052|WW2112110112892|WW2112110122498|WW2112130100671|WW2112130100661|WW2112130100653|WW2112020114175|WW2112110123198|WW2112110116637|WW2112110123086|WW2112110122648|WW2112110113172|WW2112090108886|WW2111300106626|WW2112010108245|WW2112110121798|WW2112110121647|WW2112090114465|WW2112030117566|WW2112090111236|WW2112080107588|WW2112220100960|WW2112090108216|WW2112070101097|WW2112090108187|WW2112110122278|WW2112010110118|WW2112090112498|WW2112110122875|WW2112110113043|WW2112140130406|WW2112140130598|WW2112140130586|WW2112140130485|WW2112140130568|WW2112110122136|WW2112110121418|WW2112140126695|WW2112110123676|WW2112140131028|WW2112220101172|WW2112220101182|WW2112160102751|WW2112160102742|WW2112160102661|WW2112160102672|WW2111300100697|WW2112160102722|WW2112160102711|WW2112160102700|WW2112160102693|WW2112160102681|WW2112160102653|WW2112030117026|WW2111300106748|WW2112160102643|WW2112030118068|WW2112160102631|WW2112140126068|WW2112110121678|WW2111270103376|WW2112040119327|WW2112140130968|WW2111270102277|WW2111130115477|WW2112220101220|WW2112160102731|WW2112140125607|WW2112110122418|WW2112160100096|WW2112160101058|WW2112220101263|WW2112090112206|WW2112160103975|WW2112160100418|WW2112160103665|WW2112090115008|WW2112180101067|WW2112180104458|WW2112180100387|WW2112180102848|WW2112180104417|WW2112110122587|WW2112040119245|WW2112140130298|WW2112180103137|WW2112140130865|WW2112140130607|WW2112140130526|WW2112160104367|WW2112110123906|WW2112160104357|WW2112140128577|WW2112020113478',
                        'memberID' => $this->memberId,
                        'houseID' => $this->warehouseId,
                        'page' => 1,
                        'pageSize' => 1,
                        //'status' => ''
                    ],
                    'http_errors' => false
                ]
            );


            $body = $response->getBody();
            // Implicitly cast the body to a string and echo it
            $data = json_decode($body);
            dump($data);
            dump(json_decode($data->list));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    private function createClient():Client {
        $client = new \GuzzleHttp\Client(['base_uri' => $this->base]);

        return $client;
    }
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

function number_compare($left_operand, $right_operand) {
	// 取2位小数进行比较
	$scale = 2;
	return bccomp($left_operand, $right_operand, $scale);
}

function date_compare(string $date1, string $date2 = '') {
    // 把给定的时间字符串转换成UNIX时间戳的形式
    $date1 = strtotime($date1);
    if (!$date2) {
        $date2 = time();
    } else {
        $date2 = strtotime($date2);
    }

    return number_compare($date1, $date2);
}
$ed = new Express8d();
$ed->searchWarehouseWarrantInfoList();
// $ed->getDeclareCategoryList();
// $ed->getDeclareProductorList(17);
//$ed->getUserAddressList();
//$ed->getUserWarehouseList();
//$ed->getUserTransportPortList();
//$ed->createWarehouseForecast();
/*
{#34 ▼
    +"status": "0"
    +"message": "操作成功"
    +"data": "[{forecastID:FW2012110100015}]"
}
*/

//$ed->searchWayBillInfoList();
