<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="testing2.php" method="POST" enctype="multipart/form-data">
    <input type="file" class="form-control-file" name="kyc" id="kyc" accept="pdf/*" enctype="multipart/form-data">
    <input type="submit" name="uploads" value="Upload KYC">
  </form>
 
  

</body>
</html>
<?php
if(isset($_POST['uploads'])){
    $file_name = $_FILES['kyc']['name'];
    $file_tmp_name = $_FILES['kyc']['tmp_name'];
    if(move_uploaded_file($file_tmp_name, "kyc_file/" . $file_name)){
      echo "File Uploaded";
    }else{
      echo "Please try again";
    }
  }
?>
