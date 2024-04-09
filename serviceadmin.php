<?php
require 'components/nav.php';
include 'components/db_connect.php';
?>


<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
}

?>

<?php

if(isset($_GET['approve'])){
   $status ="Approved";
   $id =$_GET['id'];
   $query = "UPDATE `userdata` SET status='$status' where id ='$id'";
   $res =mysqli_query($conn,$query);
   
   
}
if(isset($_GET['reject'])){
  $status ="Rejected";
  $id =$_GET['id'];
  $query = "UPDATE `userdata` SET status='$status' where id ='$id'";
  $res =mysqli_query($conn,$query);
  
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>This is Admin Portal</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    

</head>
<body style ="background: linear-gradient(to right, rgb(137 137 137), #98d5a6);">
    <div class= "service">
    <div class="container-fluid">
       <?php 
        $sql = "SELECT * FROM `userdata` WHERE STATUS = 'pending'";
        $result = mysqli_query($conn, $sql);
        
        ?>
        <table class="pendingservice" id = "myTable">
  <thead>
    <tr>
      <th scope="col">SL No</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile No</th>
      <th scope="col">Gender</th>
      <th scope="col">State Code</th>
      <th scope="col">Aadhar No</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Designation</th>
      <th scope="col">Hospital Id</th>
      <th scope="col">Hospital Name</th>
      <th scope="col">KYC File</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
            <tbody>
            <?php

            

$sno = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $sno = $sno + 1;
    echo "<tr>
              <th scope='row'>" . $sno . "</th>
              <td>" . $row['name'] . "</td>
              <td>" . $row['email'] . "</td>
              <td>" . $row['mobile_no'] . "</td>
              <td>" . $row['gender'] . "</td>
              <td>" . $row['state_code'] . "</td>
              <td>" . $row['aadhar_no'] . "</td>
              <td>" . $row['dob'] . "</td>
              <td>" . $row['designation'] . "</td>
              <td>" . $row['hosp_id'] . "</td>
              <td>" . $row['hosp_name'] . "</td>
              
              
              <td> <a download='" . $row['kyc_file'] . "' href='kyc_file/" . $row['kyc_file'] . "'> Download </a></td>

              <td>
              <form action='serviceadmin.php' method='GET'>
              <input type='hidden' name='id' value='" . $row['id'] . "'>

              <button class='btn btn-success confirm-action' type='submit' name='approve' id='approveButton'>Approve</button>
              <button class='btn btn-warning confirm-action' type='submit' name='reject' id='rejectButton'>Reject</button>
              </form>
              </td>
            </tr>";
}
?>

   
                    </  tbody>
                  
                  </table>
    </div>
    </div>

    <script>
  // Select all buttons with the 'confirm-action' class
  const confirmButtons = document.querySelectorAll('.confirm-action');

  // Attach a click event listener to each button
  confirmButtons.forEach((button) => {
    button.addEventListener('click', function (e) {
      if (!confirm('Are you sure you want to perform this action?')) {
        e.preventDefault();
      }
    });
  });
</script>



</body>
</html>
