<?php
$title = 'Sign Up';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    include 'connect.php';

    $username = $_POST['uname'];
    $pwd1 = $_POST['pwd1']; //TODO: salt and hash passwords
    $pwd2 = $_POST['pwd2']; //TODO: salt and hash passwords

    if ($username === '' | $pwd1 === '' | $pwd2 === '') {
        $err_di['Blank fields'] = 'Fields cannot be blank';
    }
    if (!($pwd1 === $pwd2)) {
        $err_di['Mismatched passwords'] = 'Passwords do not match';
    }
    if (!isset($err_di)) {    
        $sql_query1 = "INSERT INTO credentials VALUES ('$username','$pwd1')";
        $sql_query2 = "INSERT INTO balances VALUES ('$username',0.0,0.0,0.0)";
        $conn->autocommit(FALSE);

        if ($conn->query($sql_query1) && $conn->query($sql_query2) && $conn->commit()) {
            header('Location: return.php');
        } else {
            $err_di['Sign up error'] = 'Please try another username';
            echo $conn->connect_error;
        }
    }
    $conn->close();
}
include 'header.php';
?>
<body>
<div class="container">
  <header>
    <h1><a href='index.php'>Cash2Coin</a></h1>
  </header>
  <hr>
	<div class="jumbotron text-center">
	  <h2>Sign up here</h2>
	  <form action="signup.php" method="post" style="max-width:600px; margin:auto">
		<div class="form-group">
          <input type="text" class="form-control" placeholder="User Name" name="uname"/>
          <input type="Password" class="form-control" placeholder="Password" name="pwd1"/>
          <input type="Password" class="form-control" placeholder="Repeat Password" name="pwd2"/>
		</div>
		<button type="submit" class="btn btn-info">Sign Up</button>
        <?php
        if (isset($err_di)) {
            foreach($err_di as $err => $msg) {
                echo '<p style="color:red;">' . $err . ': ' . $msg . '</p>';
            }
        } 
        ?>
	  </form>
	</div>
  <hr>
</div>
</body>
</html>
