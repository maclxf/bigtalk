<?php
abstract class XMLGenerator {
    protected $xml;
    protected $children;

    /**
     * 类构造函数，执行一些初始化操作
     */
	public function __construct() {
        // TODO...
	}

    abstract public function generate_xml($data);

    /**
     * Convert array to Xml
     *
     * @param array            $soapRequest
     * @param SimpleXMLElement $soapRequestXml
     *
     * @return SimpleXMLElement
     */
    protected function array_to_xml($soapRequest, $soapRequestXml) {
        foreach ($soapRequest as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $soapRequestXml->addChild("$key");
                    $this->array_to_xml($value, $subnode);
                } else {
                    $subnode = $soapRequestXml->addChild("item$key");
                    $this->array_to_xml($value, $subnode);
                }
            } else {
                $soapRequestXml->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}

class LabelGenerator extends XMLGenerator {
    /**
     * 生成法邮开单用到的配置
     * @var array
     */
    private $_config = [];

    /**
     * 构造函数
     */
    public function __construct(array $config = array()) {
        parent::__construct();

        $this->_config = $config;

        // 创建 SimpleXMLElement 对象
        $this->xml = new SimpleXMLElement('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cxf="http://cxf.tracking.soap.chronopost.fr/" />');
    }


    public function generate_xml($data) {

        //$this->xml->addChild("soapenv:Header");
        $this->children = $this->xml->addChild('soapenv:Body')
                                    ->addChild('cxf:trackSkybillV2', NULL);

        // 把数组转换成xml
        $this->array_to_xml($data, $this->children);

        // 把 xml 对象转换为 string 的形式
        $requestSoap = $this->xml->asXML();
        // echo $requestSoap;
        // exit;

        // 替换 article 标签
        //$requestSoap = $this->_replace_article_tag($requestSoap);

        return $requestSoap;
    }

    private function _replace_article_tag($requestSoap) {
        $new_requestSoap = '';

        if ($requestSoap) {
            $pattern         = '/ARTICLE10000_[0-9]/';
            $replacement     = 'article';
            $new_requestSoap = preg_replace($pattern, $replacement, $requestSoap);
        }

        return $new_requestSoap;
    }
}



$data = [
	'language' => 'fr_FR',
	'skybillNumber' => 'XY629655880FR'
];
$label = new LabelGenerator();
$xml = $label->generate_xml($data);
echo $xml;
echo '<hr>';


$wsdl = 'https://www.chronopost.fr/tracking-cxf/TrackingServiceWS?wsdl';
$client = new SoapClient($wsdl);

$url = 'https://ws.chronopost.fr/tracking-cxf/TrackingServiceWS';
try {
	$response = $client->__doRequest($xml, $url, 'trackSkybillV2', 0);
} catch (SOAPFault $e) {
    echo 'Exception: ' . $e->getMessage();
    return FALSE;
}

echo $response;
// $xml = simplexml_load_string($response);
// var_dump($xml);
// $json = json_encode($xml);
// $array = json_decode($json,TRUE);
// var_dump($array);
// exit;

/*$parseResponse = new MTOM_ResponseReader($response);
echo $parseResponse;
//var_dump($response);*/