<?php
session_start();

// Check if the session variable is set
if (isset($_SESSION['uploaded_file'])) {
    $uploadedFile = $_SESSION['uploaded_file'];

    // Generate a download link
    echo '<a href="' . $uploadedFile . '" download>Download</a>';
} else {
    echo 'No file uploaded.';
}
