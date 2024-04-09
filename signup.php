<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=='POST'){

include 'components/db_connect.php';
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];

$exists = false;

if(($password==$cpassword) && $exists == false){
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp());";
$result =mysqli_query($conn,$sql);
if($result){
  $showAlert =true;
}
}
  else{
    $showError = "Password do not match";
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require 'components/nav.php';
?>
<?php
if($showAlert){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created and you can login
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($showError){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed!</strong>'.$showError.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
?>

<div class ="container">
    <H1> Sign Up Now</H1>
    <form aciton ="/FileUploadSystem/signup.php" method ="post">
  <div class="form-group my-4">
    <label for="email">Email address</label>
    <input type="text" maxlength="11" class="form-control" id="email" name="username" aria-describedby="emailHelp" placeholder="Enter email" required>

  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name ="password" namespace="password" placeholder="Password" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"> Confirm Password</label>
    <input type="password" class="form-control" id="cpassword"  name= "cpassword" placeholder="Password" required
    >
    <small id="emailHelp" class="form-text text-muted">Confirm your password again</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
</div>

</body>
</html>