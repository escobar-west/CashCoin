<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use Coinbase\Wallet\Enum\CurrencyCode;
use Coinbase\Wallet\Resource\Transaction;
use Coinbase\Wallet\Value\Money;
$title = 'Send';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $address = $_POST['address'];
    $amt = $_POST['amt'];
    $currency = $_POST['currency'];
    $username = $_SESSION['username'];

    include 'connect.php';

    $sql = "SELECT * FROM balances
            WHERE username = '$username'";

    $result = $conn->query($sql);

    if(!$result)
    {
        die('query failed');
    }
    $balance = $result->fetch_assoc()[$currency];
        
	date_default_timezone_set('America/New_York');

	$api_key = "EaTfh0IH4ATDXnDd";
	$api_secret = "4jbVFe95k4i2bGYLLZNofsyTlUQAQH8M";
	$api_url = 'https://api.coinbase.com/v2/';

	$configuration = Configuration::apiKey($api_key, $api_secret);
	$client = Client::create($configuration);
    $coinbase_time = $client->getTime(); //TODO: remove this variable completely from code

    $eth_price = $client->getBuyPrice('ETH')->getAmount();

    if ($amt > $balance * $eth_price) {
        die('User error: Amount is greater than balance<br><a href=send.php>Return</a>');
    } else {
        echo "<br>the amount requested is: " . $amt;
        echo "<br>the balance is: " . $balance;

        print_r($coinbase_time);
        echo '<br>Server time: ' . date("h:i:sa") . '<br>Coinbase time: ' . $coinbase_time;
		$account_id = '24a83a4a-8446-577a-ab2e-226baca74775';
		$account = $client->getAccount($account_id);

		$transaction = Transaction::send([
			'toBitcoinAddress' => $address,
			'amount'   => new Money($amt, CurrencyCode::USD),
			'description'  => 'You sent eth!'
		]);

		$client->createAccountTransaction($account, $transaction);
    }
}
include 'header.php';
?>
<body>
<div class="container">
  <header>
    <h1>Send</h1>
  </header>
  <hr>
	<div class="jumbotron text-center">
	  <h2>Send to external address</h2>
	  <form action="send.php" method="post" style="max-width:600px; margin:auto">
		<div class="form-group">
          <input type="text" class="form-control" placeholder="Wallet Address" name="address"/>
          <input type="number" class="form-control" placeholder="Amount" step="0.01" name="amt"/> <!--TODO fix little arrow buttons (delete/modify amt change)-->
          <input type="radio" name="currency" value="btc" disabled='disabled'>BTC<br>
          <input type="radio" name="currency" value="eth" checked>ETH<br>
          <input type="radio" name="currency" value="ltc" disabled='disabled'>LTC<br><br>
		</div>
		<button type="submit" class="btn btn-info">Send</button>
	  </form>
	</div>
  <hr>
</div>
</body>
</html>
