<?php
$title = 'Sign Up';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['uname'];
    $pwd1 = $_POST['pwd1']; //TODO: salt and hash passwords
    $pwd2 = $_POST['pwd2']; //TODO: salt and hash passwords

    include 'connect.php';

    if($conn->connect_error)
    { // if connection error, kill the link
        die('Connection failed');
    } else { // if successful connection, add them to database
        $sql_query1 = "INSERT INTO credentials VALUES ('$username','$pwd1')"; // usernames should be unique
        $sql_query2 = "INSERT INTO balances VALUES ('$username',0.0,0.0,0.0)"; // create balance account as well

        $conn->autocommit(FALSE);
        if($conn->query($sql_query1) && $conn->query($sql_query2) && $conn->commit())
        {
            header('Location: return.php');
        } else {
            echo 'sign up failed: ' . $sql_query1 . '<br>' . $conn->connect_error;//TODO: Fix error message
        }
    }
}

include 'header.php';

?>
<body>
<div class="container">
  <header>
    <h1>H1 HEADER</h1>
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
	  </form>
	</div>
  <hr>
</div>
</body>
</html>
