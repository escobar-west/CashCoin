<?php
$title = 'Home';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo 'Login not implemented';
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
	  <form action="" method="post" style="max-width:600px; margin:auto">
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
