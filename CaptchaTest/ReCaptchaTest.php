<?php
require_once __DIR__ . '/../vendor/autoload.php';


$recaptcha = new \ReCaptcha\ReCaptcha('123');
$resp = $recaptcha->setExpectedHostname('recaptcha-demo.appspot.com')
                  ->verify($gRecaptchaResponse, $remoteIp);
if ($resp->isSuccess()) {
    // Verified!
} else {
    $errors = $resp->getErrorCodes();
}