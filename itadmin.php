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
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        
        h1 {
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 100%; /* Set to 100% for full width */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #333;
            color: #fff;
        }
        
        .pending {
            background-color: #ffcccb;
        }
        
        .completed {
            background-color: #c3e6cb;
        }
        @media (min-width: 1400px)
            .container {
            max-width: 1350px !important;
            }
    </style>
</head>
<body>
    <header>
        <h1>Admin Page</h1>
    </header>
    <div class="container">
        <h2>Pending Requests</h2>
        <table>
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
            <tbody>
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
            </tbody>
        </table> <br><br><br>
        
        <h2>Completed Requests</h2>
        <table>
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
$sql = "SELECT * FROM `userdata` WHERE STATUS = 'Id Has Been Created'";
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
        
      
    </tr>";
}
   ?>         </tbody>
        </table>
    </div>
</body>
</html>
