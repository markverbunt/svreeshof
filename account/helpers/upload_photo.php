<?php
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["ProfilePhoto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["ProfilePhoto"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["ProfilePhoto"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["ProfilePhoto"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["ProfilePhoto"]["name"])). " has been uploaded.";
    include_once('db.php');
    $hashed_id = $_POST['hashed_id'];
    $profile_photo = htmlspecialchars( basename( $_FILES["ProfilePhoto"]["name"]));

    ini_set('display_errors', 'On');
    ini_set('display_startup_errors', 'On');
    error_reporting(E_ALL);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    if ($stmt = $mysqli->query("UPDATE users SET profile_photo='$profile_photo' WHERE hashed_id='$hashed_id'")) {
        header("location: /account/edit_profile.php");
    }
    mysqli_stmt_close($stmt);
    $mysqli->close();
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>