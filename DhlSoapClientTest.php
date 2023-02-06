<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

class WsseAuthHeader extends \SoapHeader
{
    private $wss_ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';

    function __construct($user, $pass, $ns = null) {
        if ($ns)
        {
            $this->wss_ns = $ns;
        }

        $auth = new stdClass();
        $auth->Username = new SoapVar($user, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns);
        $auth->Password = new SoapVar($pass, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns);

        $username_token = new stdClass();
        $username_token->UsernameToken = new SoapVar($auth, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns);

        $security_sv = new SoapVar
        (
            new SoapVar($username_token, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns),
            SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'Security', $this->wss_ns
        );

        parent::__construct($this->wss_ns, 'Security', $security_sv, true);
    }
}

$path_wsdl = "https://wsbexpress.dhl.com/sndpt/expressRateBook?WSDL";
$location = "https://wsbexpress.dhl.com/sndpt/expressRateBook";
$username = '220286448';
$password = 'U#2lE@6xD^4u';

$client     = new SoapClient($path_wsdl);
$wsseHeader = new WsseAuthHeader($username, $password);
$client->__setSoapHeaders([$wsseHeader]);

$xml = <<<aaa
<?xml version="1.0" encoding="UTF-8"?>
<ShipmentRequest xsi:noNamespaceSchemaLocation="ShipmentMsgRequest.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<RequestedShipment>
<ShipmentInfo>
<DropOffType>REQUEST_COURIER</DropOffType>
<ServiceType>U</ServiceType>
<Account> XXXXXXXXX</Account>
<Currency>EUR</Currency>
<UnitOfMeasurement>SI</UnitOfMeasurement>
<PackagesCount>1</PackagesCount>
<LabelType>PDF</LabelType>
<LabelTemplate>ECOM26_84_001</LabelTemplate>
</ShipmentInfo>
<ShipTimestamp>2010-10-29T09:30:47GMT+01:00</ShipTimestamp>
<PickupLocationCloseTime>16:12</PickupLocationCloseTime>
<SpecialPickupInstruction>fragile items</SpecialPickupInstruction>
<PickupLocation>west wing 3rd Floor</PickupLocation>
<PaymentInfo>DAP</PaymentInfo>
<InternationalDetail>
<Commodities>
<NumberOfPieces>1</NumberOfPieces>
<Description>ppps sd</Description>
<CountryOfManufacture>CZ</CountryOfManufacture>
<Quantity>1</Quantity>
<UnitPrice>10</UnitPrice>
<CustomsValue>1</CustomsValue>
</Commodities>
<Content>NON_DOCUMENTS</Content>
</InternationalDetail>
<Ship>
<Shipper>
<Contact>
<PersonName>John Smith</PersonName>
<CompanyName>DHL</CompanyName>
<PhoneNumber>003932423423</PhoneNumber>
<EmailAddress>John.Smith@dhl.com</EmailAddress>
</Contact>
<Address>
<StreetLines>V Parku 2308/10</StreetLines>
<City>Prague</City>
<PostalCode>14800</PostalCode>
<CountryCode>CZ</CountryCode>
</Address>
</Shipper>
<Recipient>
<Contact>
<PersonName>Jane Smith</PersonName>
<CompanyName>Deutsche Post DHL</CompanyName>
<PhoneNumber>004922832432423</PhoneNumber>
<EmailAddress>Jane.Smith@dhl.de</EmailAddress>
</Contact>
<Address>
<StreetLines>Via Felice Matteucci 2</StreetLines>
<City>Firenze</City>
<PostalCode>50127</PostalCode>
<CountryCode>IT</CountryCode>
</Address>
</Recipient>
</Ship>
<Packages>
<RequestedPackages number="1">
<InsuredValue>10</InsuredValue>
<Weight>9.0</Weight>
<Dimensions>
<Length>46</Length>
<Width>34</Width>
<Height>31</Height>
</Dimensions>
<CustomerReferences>TEST CZ-IT</CustomerReferences>
</RequestedPackages>
</Packages>
</RequestedShipment>
</ShipmentRequest>
aaa;

$b = simplexml_load_string($xml);

$a = $client->__doRequest($b, $location, 'CreateShipmentRequest', 1);
//$a = $client->CreateShipmentRequest($b);
var_dump($client->__getLastRequest());
var_dump($client->__getLastRequestHeaders());
