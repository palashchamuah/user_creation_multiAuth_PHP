<?php
require 'components/nav.php';
include 'components/db_connect.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
}

// Check if the button was clicked
if (isset($_GET['Button_text'])) {
    $status = "Id Has Been Created";
    $id = $_GET['id'];
    $query = "UPDATE `userdata` SET status='$status' WHERE id ='$id'";
    $res = mysqli_query($conn, $query);

    // Store the new button text in a session variable
    $_SESSION['button_text'] = $status;
}

// Default button text
$defaultButtonText = "Pending in IT";

// Get the button text from the session, if it exists
$buttonText = isset($_SESSION['button_text']) ? $_SESSION['button_text'] : $defaultButtonText;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>This is Admin Portal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable2').DataTable();
        });
    </script>
</head>

<body>
    <div class="itadmin">
        <div class="container-fluid" my-4>
            <h2 class="text-center">Request Pending in IT</h2><br>
            <table class="pending" id="myTable2">
                <thead>
                    <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Name</th>
                        <th scope="col">ID Type</th>
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
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody> <?php
$sql = "SELECT * FROM `userdata` WHERE STATUS = 'approved'";
$result = mysqli_query($conn, $sql);
$sno = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $sno++;
    echo "<tr>
        <th scope='row'>" . $sno . "</th>
        <td>" . $row['name'] . "</td>
        <td>" . $row['id_type'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['mobile_no'] . "</td>
        <td>" . $row['gender'] . "</td>
        <td>" . $row['state_code'] . "</td>
        <td>" . $row['aadhar_no'] . "</td>
        <td>" . $row['dob'] . "</td>
        <td>" . $row['designation'] . "</td>
        <td>" . $row['hosp_id'] . "</td>
        <td>" . $row['hosp_name'] . "</td>
        <td>
            <img src='data:image/jpeg;base64," . base64_encode($row['kyc_file']) . "' alt='KYC Image' width='100' height='100'>
        </td>
        <td>
            <form action='itadmin.php' method='GET'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>";

    // Place the dynamic button text here
    $buttonText = "Pending";
    
    echo "<button type='submit' class='btn btn-primary' name='Button_text'>" . $buttonText . "</button>
            </form>
        </td>
    </tr>";
}
?> </tbody>
            </table> <br><br>
        </div>
        <div class="container-fluid"><br>
            <h2 class="text-center">Total Completed Request</h2><br></strong> <?php 
        $sql = "SELECT * FROM `userdata` WHERE STATUS = 'Id Has Been Created'";
        $result = mysqli_query($conn, $sql);
        
        ?> <table class="table" id="completed">
                <thead>
                    <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Name</th>
                        <th scope="col">ID Type</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">Gender</th>
                        <th scope="col">State Code</th>
                        <th scope="col">Aadhar No</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Hospital Id</th>
                        <th scope="col">Hospital Name</th>
                    </tr>
                </thead>
                <tbody> <?php

            

$sno = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $sno = $sno + 1;
    echo "<tr>
              <th scope='row'>" . $sno . "</th>
              <td>" . $row['name'] . "</td>
              <td>" . $row['id_type'] . "</td>
              <td>" . $row['email'] . "</td>
              <td>" . $row['mobile_no'] . "</td>
              <td>" . $row['gender'] . "</td>
              <td>" . $row['state_code'] . "</td>
              <td>" . $row['aadhar_no'] . "</td>
              <td>" . $row['dob'] . "</td>
              <td>" . $row['designation'] . "</td>
              <td>" . $row['hosp_id'] . "</td>
              <td>" . $row['hosp_name'] . "</td>
            
              
            </tr>";
}
?> </ tbody>
            </table>
        </div>
    </div>
    </div>
</body>

</html>