<?php
   require 'components/nav.php';
   ?>
<?php
   session_start();
   if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
       header("location: login.php");
   }
   
   if($_SERVER["REQUEST_METHOD"]=='POST'){


    //var_dump($_FILES); exit;
   
       include 'components/db_connect.php';
       $name = $_POST["name"];
       $id_type = $_POST["id_type"];
       $email = $_POST["email"];
       $mobile = $_POST["mobile"];
       $gender = $_POST["gender"];
       $statecode = $_POST["statecode"];
       $aadhar = $_POST["aadhar"];
       $dob = $_POST["dob"];
       $designation = $_POST["designation"];
       $hospid = $_POST["hospid"];
       $hospname = $_POST["hospname"];
       $kyc = $_POST["kyc"];
       
   
   
       $server ="localhost";
       $username ="root";
       $password ="";
       $database ="fileuploadsystem";
   
       $conn =mysqli_connect($server,$username,$password,$database);
   
       if (!$conn){
          echo "Unable to connect to the database"; 
          
       }
       else{

        //save the files

        if(isset($_FILES['kyc'])){
          $file_name = $_FILES['kyc']['name'];
          $file_tmp_name = $_FILES['kyc']['tmp_name'];
          if(move_uploaded_file($file_tmp_name, "kyc_file/" . $file_name)){
            echo "File Uploaded";
            $_SESSION['uploaded_file'] = "kyc_file/" . $file_name;
          }else{
            echo "Please try again";
          }
        }

        //add the filename/path to DB
           
           $sql = 
           "INSERT INTO `userdata` 
           (`name`, `id_type`, `email`, `mobile_no`, `gender`, `state_code`, `aadhar_no`, `dob`, `designation`, `hosp_id`, `hosp_name`, `kyc_file`) 
           VALUES 
           ('$name', '$id_type', '$email', '$mobile', '$gender', '$statecode', '$aadhar', '$dob', '$designation', '$hospid', '$hospname', '$kyc')";
           
               $result = mysqli_query($conn,$sql); 
   
           if($result){
             $successMessage = "Success! Your data has been successfully submited.";
             echo '<div class="success">' . $successMessage . '</div>';
           }
           else{
               echo "Fail submiting data! Please try again";        
           }
   
   
       }
       
       }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Create BIS/TMS Id</title>
   </head>
   <body  style ="background: linear-gradient(to right, rgb(137 137 137), #98d5a6);">
      <div class="welcome">
      <div class="container">
         <div class="w-50 mx-auto">
            <h2>Fill up the form to create BIS/TMS Id's</h2>
            <br>
            <form action ="welcome.php" method = "POST"  enctype="multipart/form-data">
               <div class="form-group">
                  <strong><label for="name">Name</label></strong>
                  <input type="text" class="form-control" name ="name" id="name" placeholder="Name">
               </div>
               <div class="form-group">
               <strong> <p>Choose Your ID Type:</p></strong>
                 <strong> <label for="male">TMS ID</label>
                  <input type="radio" name="id_type" id="tms" value="TMS ID">
                  <label for="female">BIS ID</label>
                  <input type="radio" name="id_type" id="bis" value="BIS ID">
                  </fieldset>
               </div>
               <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" name= "email"id="email" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
               </div>
               <div class="form-group">
                  <label for="name">Mobile No</label>
                  <input type="tel" class="form-control" name ="mobile" id="mobile" placeholder="Mobile Number">
               </div>
               <div class="form-group">
                  <p>Choose your gender:</p>
                  <label for="male">Male</label>
                  <input type="radio" name="gender" id="male" value="male" checked>
                  <label for="female">Female</label>
                  <input type="radio" name="gender" id="female" value="female">
                  </fieldset>
               </div>
               <div class="form-group">
                  <label for="name">State Code</label>
                  <input type="number" class="form-control" name ="statecode" id="statecode" placeholder="Enter State Code">
               </div>
               <div class="form-group">
                  <label for="name">Aadhar Number</label>
                  <input type="number" class="form-control" name ="aadhar" id="aadhar" placeholder="Your Aadhar Number">
               </div>
               <div class="form-group">
                  <label for="name">Date Of Birth</label>
                  <input type="date" class="form-control" name ="dob" id="dob" placeholder="Enter Date of Birth ">
               </div>
               <div class="form-group">
                  <label for="name">Designation</label>
                  <input type="text" class="form-control" name ="designation" id="designation" placeholder="Your Designation">
               </div>
               <div class="form-group">
                  <label for="name">Hospital Id</label>
                  <input type="number" class="form-control" name ="hospid" id="hospid" placeholder="Hospital Id ">
               </div>
               <div class="form-group">
                  <label for="name">Hospital Name</label>
                  <input type="text" class="form-control" name ="hospname" id="hospname" placeholder="Hospital Name ">
               </div>
               <div class="form-group">
               <input type="file" class="form-control-file" name="kyc" id="kyc" accept="pdf/*" enctype="multipart/form-data">
               </div>
            <button type="submit" class="btn btn-primary"  onclick="return confirm('Are you sure?')" >Submit</button><br><br><br><br>
            </form>
         </div>
      </div>
   </body>
</html>
