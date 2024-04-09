<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=='POST'){

include 'components/db_connect.php';
$username = $_POST["username"];
$password = $_POST["password"];


//$sql = "Select * from users where username ='$username' AND password ='$password'";
$sql = "Select * from users where username ='$username'";
$result =mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num == 1){
  while($row=mysqli_fetch_assoc($result)){
    if(password_verify($password,$row['password']) AND ($row["usertype"]=="user")){
         $login =true;
         session_start(); 
            $_SESSION['loggedin']=true;
            $_SESSION['username']= $username;
            header("location: welcome.php");

    }
    if(password_verify($password,$row['password']) AND ($row["usertype"]=="admin")){
      $login =true;
      session_start(); 
         $_SESSION['loggedin']=true;
         $_SESSION['username']= $username;
         header("location: serviceadmin.php");
         

    }
    if(password_verify($password,$row['password']) AND ($row["usertype"]=="itadmin")){
      $login =true;
      session_start(); 
         $_SESSION['loggedin']=true;
         $_SESSION['username']= $username;
         header("location: itadmin.php");

    }

    else{
      $showError = "Invalid Credentials";
    }
  }
     
}

  else{
    $showError = "Invalid Credentials";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php
require 'components/nav.php';
?>
<?php
if($login){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged In
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form aciton ="/FileUploadSystem/login.php" method ="post">
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your Username and Password!</p>

              <div class="form-outline form-white mb-4">
              <label for="email">Username</label>
    <input type="text" class="form-control form-control-lg" id="email" name="username" aria-describedby="emailHelp" placeholder="Enter email">
              </div>

              <div class="form-outline form-white mb-4">
              <label for="password">Password</label>
    <input type="password" class="form-control form-control-lg" id="password" name ="password" namespace="password" placeholder="Password">
              </div>


              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

            </div>

           

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</from>
    
</body>
</html>