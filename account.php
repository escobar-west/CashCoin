<?php
session_start();
$title = 'Account';

if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}

$username = $_SESSION['username'];

include 'connect.php';

$sql_query = "SELECT username, eth FROM balances WHERE username = '$username'";

$result = $conn->query($sql_query);

if(!$result) {
    die('query failed');
}

if($result->num_rows == 1) {
    $eth_balance = $result->fetch_assoc()['eth'];
} else {
    die('Could not find user!' . $sql_query);
}
$conn->close();
include 'header.php';
?>
<body>
<div class="container">
  <header>
    <h1>Welcome, <?php echo $username;?></h1>
  </header>
  <hr>
    <div class="jumbotron text-center">
      <h2>Account</h2>
      <br>
      <p>Your account balance is <?php echo $eth_balance;?><p>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#sendModal">Send</button>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#transferModal">Transfer</button>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#redeemModal">Redeem</button>
    </div>
  <hr>
  <!-- Send Modal -->
  <div class="modal fade" id="sendModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Send Ether to an address</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form action="send.php", method="post" style="max-width:600px; margin:auto">
             <input type="text" placeholder='Address' name="address">
             <br>
             <input type="text" placeholder='Amount' name="amount">
             <br>
             <button type="submit" class="btn btn-success">Send</button>
          </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Redeem Modal -->
  <div class="modal fade" id="redeemModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Redeem from coupon</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form action="redeem.php", method="post" style="max-width:600px; margin:auto">
             <input type="text" placeholder='Coupon' name="secret">
             <br>
             <button type="submit" class="btn btn-success">Redeem</button>
          </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Transfer Modal -->
  <div class="modal fade" id="transferModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Transfer credits</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form action="transfer.php", method="post" style="max-width:600px; margin:auto">
             <input type="text" placeholder='User name' name="username">
             <br>
             <input type="text" placeholder='Amount' name="amount">
             <br>
             <button type="submit" class="btn btn-success">Transfer</button>
          </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
