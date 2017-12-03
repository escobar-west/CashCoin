<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;

$title='Redeem';

$username = $_SESSION['username'];
$secret = $_POST['secret'];
include 'connect.php';

$sql_query = "SELECT * FROM coupons WHERE secret = '$secret'";

$result = $conn->query($sql_query);

if(!$result) {
    die('Query failed');
}
if($result->num_rows == 1) {
    date_default_timezone_set('America/New_York');

	$api_key = "EaTfh0IH4ATDXnDd";
	$api_secret = "4jbVFe95k4i2bGYLLZNofsyTlUQAQH8M";
	$api_url = 'https://api.coinbase.com/v2/';
	$configuration = Configuration::apiKey($api_key, $api_secret);
	$client = Client::create($configuration);
		
    $coupon_value = $result->fetch_assoc()['value'];
    print_r($client->getBuyPrice('BTC'));
    $eth_amt = $coupon_value;// / float($client->getBuyPrice('ETH');

    $sql_query = "UPDATE balances SET eth = eth + $eth_amt WHERE username = '$username'";
    if($conn->query($sql_query) === TRUE) {
        echo "Record updated";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    die('Could not find coupon!' . $sql_query);
}
$conn->close();
echo '<a href="account.php">Return to account</a>';
?>
