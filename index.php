<?php
session_start();
$title = 'Home';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connect.php';

    $username = $_POST['uname'];
    $password = $_POST['pwd'];
    $sql_query = "SELECT * FROM credentials
                  WHERE username = '$username' 
                  AND password = '$password'";

    $result = $conn->query($sql_query);

    if ($result) {
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['username'] = $user['username'];
            header('Location: account.php');
        } else {
            $err_di['Login error'] = 'Could not log in';
        }
    } else {
        $err_di['Query error'] = 'Could not return query';
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
	  <h2>Sign in here</h2>
	  <form action="index.php" method="post" style="max-width:600px; margin:auto">
		<div class="form-group">
          <input type="text" class="form-control" placeholder="User Name" name="uname"/>
          <input type="Password" class="form-control" placeholder="Password" name="pwd"/>
		</div>
		<button type="submit" class="btn btn-success">Log in</button>
        <?php
        if (isset($err_di)) {
            foreach($err_di as $err => $msg) {
                echo '<p style="color:red;">' . $err . ': ' . $msg . '</p>';
            }
        }
        ?>
	  </form>
	  <a href="signup.php" class="btn btn-link">Sign Up Here</a>
	</div>
  <hr>
</div>
</body>
</html>
