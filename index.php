<?php
session_start();
$title = 'Home';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['pwd'];

    include 'connect.php';

    if($conn->connect_error) {
        die('Connection failed');
    } else {
        $sql_query = "SELECT * FROM credentials
                      WHERE username = '$username'
                      AND password = '$password'";

        $result = $conn->query($sql_query);

        if(!$result) {
            die('query failed');
        }

        if($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $_SESSION['username'] = $user['username'];
            header('Location: account.php');
        } else {
            echo "Error: Could not find user in database\n" . $sql_query;
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
	  <h2>Sign in here</h2>
	  <form action="index.php" method="post" style="max-width:600px; margin:auto">
		<div class="form-group">
          <input type="text" class="form-control" placeholder="User Name" name="uname"/>
          <input type="Password" class="form-control" placeholder="Password" name="pwd"/>
		</div>
		<button type="submit" class="btn btn-success">Log in</button>
	  </form>
	  <a href="signup.php" class="btn btn-link">Sign Up Here</a>
	</div>
  <hr>
</div>
</body>
</html>
