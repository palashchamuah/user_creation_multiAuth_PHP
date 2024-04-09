<?php
require 'components/nav.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    include 'components/db_connect.php';

    // Escape user inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $mobile = mysqli_real_escape_string($conn, $_POST["mobile"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $statecode = mysqli_real_escape_string($conn, $_POST["statecode"]);
    $aadhar = mysqli_real_escape_string($conn, $_POST["aadhar"]);
    $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
    $designation = mysqli_real_escape_string($conn, $_POST["designation"]);
    $hospid = mysqli_real_escape_string($conn, $_POST["hospid"]);
    $hospname = mysqli_real_escape_string($conn, $_POST["hospname"]);

    // File Upload
    if (isset($_FILES['kyc'])) {
        $file_name = $_FILES['kyc']['name'];
        $file_tmp_name = $_FILES['kyc']['tmp_name'];
        $file_destination = "kyc_file/" . $file_name;

        if (move_uploaded_file($file_tmp_name, $file_destination)) {
            // File uploaded successfully
            $kyc = $file_destination;
        } else {
            echo "File upload failed. Please try again.";
            exit;
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO `userdata` 
            (`name`, `email`, `mobile_no`, `gender`, `state_code`, `aadhar_no`, `dob`, `designation`, `hosp_id`, `hosp_name`, `kyc_file`) 
            VALUES 
            ('$name', '$email', '$mobile', '$gender', '$statecode', '$aadhar', '$dob', '$designation', '$hospid', '$hospname', '$kyc')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $successMessage = "Success! Your data has been successfully submitted.";
        echo '<div class="success">' . $successMessage . '</div>';
    } else {
        echo "Failed to submit data. Please try again.";
    }

    // Close the database connection
    mysqli_close($conn);
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
<body style="background: linear-gradient(to right, rgb(137 137 137), #98d5a6);">
<div class="welcome">
    <div class="container">
        <div class="w-50 mx-auto">
            <h2>Fill out the form to create BIS/TMS Id's</h2>
            <br>
            <form action="welcome.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                           placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <!-- Add more form fields here as needed -->
                <div class="form-group">
                    <input type="file" class="form-control-file" name="kyc" id="kyc" accept="application/pdf">
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">Submit</button><br><br><br><br>
            </form>
        </div>
    </div>
</body>
</html>
