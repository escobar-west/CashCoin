<?php
require __DIR__ . '/vendor/autoload.php';
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use Coinbase\Wallet\Enum\CurrencyCode;
use Coinbase\Wallet\Resource\Transaction;
use Coinbase\Wallet\Value\Money;

date_default_timezone_set('America/New_York');

$api_key = "EaTfh0IH4ATDXnDd";
$api_secret = "4jbVFe95k4i2bGYLLZNofsyTlUQAQH8M";
//$api_key = "IYcePj9WfDNjWkQ0";
//$api_secret = "aovkx2PKdVPXpyexOWE8Iv7xj0AsfTnB";


$api_version = '2017-10-17';
$api_url = 'https://api.coinbase.com/v2/';

$configuration = Configuration::apiKey($api_key, $api_secret);
$client = Client::create($configuration);

$currencies = $client->getCurrencies();

print_r($currencies);

//$buyPrice = $client->getBuyPrice('BTC-USD');
//print_r($buyPrice);

$account_id = '24a83a4a-8446-577a-ab2e-226baca74775';

$account = $client->getAccount($account_id);
//print_r($account);

$current_user = $client->getCurrentUser();
//print_r($current_user);

//$transaction = Transaction::send([
//    'toBitcoinAddress' => '0xCA57b3E1B95Eb97aE09448F0404Cff7BC9F3540D',
//    'amount'   => new Money(0.02, CurrencyCode::ETH),
//    'description'  => 'Your first eth!'
//]);

//$client->createAccountTransaction($account, $transaction);

?>
