<?php require_once 'php_action/db_connect.php'; ?>

<?php
session_start();
if($_POST) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username = '$username'";
  $success = mysqli_query($connect,$query);
  if($success->num_rows == 1){
    $password = md5($password);
    $mainQuery = "SELECT * FROM users WHERE password = '$password' AND username = '$username'";
    $mainSuccess = mysqli_query($connect,$mainQuery);
    if($mainSuccess->num_rows == 1){
        $user = $mainSuccess->fetch_assoc();
        $users = $user['username'];
        $_SESSION['username'] = $users;
        header('location:'.$store_url.'home.php');
    }else{
      echo "an error has occured, recheck username and password";
    }
  }
}



?>
<html>
<head>
	<title>Stock Management System</title>


	<!-- bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="/preorder/custom/home.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>


</head>

<body>
<div class="container">
  <div class="row vertical">
    <div class="col-md-12 col-md-offset-4">
      <div class="panel panel-info">

        <div class="panel-body">

          <div class="messages">

          </div>
          <div class="box">
          <form class="form-horizontal" method="post" id="loginForm">
            <fieldset>
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </div>
            </fieldset>
          </form>
          </div>

        </div>
        <!-- panel-body -->
      </div>
      <!-- /panel -->
    </div>
    <!-- /col-md-4 -->
  </div>
  <!-- /row -->
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

</script>

</body>
</html>
