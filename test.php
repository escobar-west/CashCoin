<?php
$api_key = "EaTfh0IH4ATDXnDd";
$api_secret = "4jbVFe95k4i2bGYLLZNofsyTlUQAQH8M";
$api_version = '2017-10-17';
$api_url = 'https://api.coinbase.com/v2/';

$ch = curl_init($api_url . 'time');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = json_decode(curl_exec($ch), true);

$timestamp = $result['data']['epoch'];
$message = $timestamp . 'GET' . $api_url . 'accounts';
$signature = hash_hmac('sha256', $message, $api_secret);

$headers = array(
    "CB-ACCESS-SIGN: " . $signature,
    "CB-ACCESS-TIMESTAMP: " . $timestamp,
    "CB-ACCESS-KEY: " . $api_key,
    "CB-VERSION: " . $api_version
);
print_r($headers);

echo '<br><br>';

$ch2 = curl_init($api_url . 'accounts');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
$result = json_decode(curl_exec($ch2), true);

print_r($result);//['data'][0]['name'];
?>
