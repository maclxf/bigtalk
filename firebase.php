<?php
require_once __DIR__ . './vendor/autoload.php';

use \Limelight\Limelight;


$key = "SY0pPsFH";
$payload = array(
    "iss" => "http://bigtalk.to2p",
    "aud" => "http://bigtalk.top",
    "iat" => 1356999524,
    "nbf" => 1357000000
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($payload, $key);
echo $jwt;
//$decoded = JWT::decode($jwt, $key, array('HS256'));
echo '<br>';

$jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGktYWRpLXYzLnRvcFwvIiwiYXVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwODAiLCJpYXQiOjE1NzU2MzI3NDgsIm5iZiI6MTU3NTYzMjc0OCwiZXhwIjoxNTc1NjMyNzQ5LCJwYXJhbXMiOnsibmFtZSI6IiRcdTVjZjAiLCJoZWFkX2ltZyI6IiRcdTVjZjAifX0.I-VPDAbv9GOA5zK1atwRJ6ulxD1_U6eiYNbwcJjysqM';

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

//$decoded_array = (array) $decoded;
//print_r($decoded_array);
/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($jwt, $key, array('HS256'));
print_r($decoded);


