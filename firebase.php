<?php
require_once __DIR__ . './vendor/autoload.php';

use \Firebase\JWT\JWT;


$key = "qqq";
$payload = array(
    "iss" => "http://api.gsedu.top",
            "aud" => "http://mp.gsedu.top",
            "exp" => time() + 60*60,
            "sub" => 'kk'
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

$jwt = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuZ3NlZHUudG9wIiwiYXVkIjoiaHR0cDpcL1wvbXAuZ3NlZHUudG9wIiwiZXhwIjoxNTk3NzY1NTA4LCJzdWIiOiJrayJ9.OZ5uJY4ESbMcPCxCPz5utCgWUTGhq4qm8L6iqCMy3ko';

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


