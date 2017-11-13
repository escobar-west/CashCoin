<?php
session_start();
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
    $coupon_value = $result->fetch_assoc()['value'];
    $sql_query = "UPDATE balances SET eth = eth + $coupon_value WHERE username = '$username'";
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
