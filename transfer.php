<?php
session_start();
$title='Transfer';

$username = $_SESSION['username'];
$transfer_user = $_POST['username'];
$transfer_amount = $_POST['amount'];

echo $username . ' ' . $transfer_user . ' ' . $transfer_amount;
include 'connect.php';

$sql_query = "SELECT * FROM balances WHERE username = '$username'";

$result = $conn->query($sql_query);

if(!$result) {
    die('Query failed');
}
if($username != $transfer_user && $result->num_rows == 1) {
    $balance = $result->fetch_assoc()['eth'];
    if($balance >= $transfer_amount) {
        $sql_transfer = "UPDATE balances
                         SET eth = CASE
                                     WHEN username = '$transfer_user' THEN eth + $transfer_amount
                                     WHEN username = '$username' THEN eth - $transfer_amount
                                   END
                         WHERE username = '$username' OR username = '$transfer_user'";
        $conn->autocommit(FALSE);
        if ($conn->query($sql_transfer) && $conn->affected_rows >= 2) {
            if($conn->commit()) {
                $conn->close();
                echo 'Successfully transfered balances!<br>';
            } else {
                die('Could not complete transfer');
            }
        } else {
            die('Failed to update both accounts'. $conn->affected_rows);
        }
    } else {
        die('You do not have that much ETH in your balance');
    }
} else {
    die('Could not find user');
}
echo '<a href="account.php">Return to account</a>';
?>
