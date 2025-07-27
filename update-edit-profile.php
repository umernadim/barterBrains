<?php
include "config.php";
session_start();

$user_id = $_SESSION["user_id"];

// cover photo
$cover_photo_name = "";
if (isset($_FILES["cover_photo"]["name"]) && $_FILES["cover_photo"]["name"] != "") {
    $file_name = $_FILES['cover_photo']['name'];
    $file_size = $_FILES['cover_photo']['size'];
    $file_tmp = $_FILES['cover_photo']['tmp_name'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $allowed_ext = ['jpeg', 'jpg', 'png'];

    if (in_array($file_ext, $allowed_ext) && $file_size <= 3145728) {
        $cover_photo_name = time() . "-" . basename($file_name);
        move_uploaded_file($file_tmp, "uploads/" . $cover_photo_name);
    }
}

// profile photo
$profile_photo_name = "";
if (isset($_FILES["profile_photo"]["name"]) && $_FILES["profile_photo"]["name"] != "") {
    $file_name = $_FILES['profile_photo']['name'];
    $file_size = $_FILES['profile_photo']['size'];
    $file_tmp = $_FILES['profile_photo']['tmp_name'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $allowed_ext = ['jpeg', 'jpg', 'png'];

    if (in_array($file_ext, $allowed_ext) && $file_size <= 3145728) {
        $profile_photo_name = time() . "-" . basename($file_name);
        move_uploaded_file($file_tmp, "uploads/" . $profile_photo_name);
    }
}

$fname = mysqli_real_escape_string($connect, $_POST['fname']);
$lname = mysqli_real_escape_string($connect, $_POST['lname']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$city = mysqli_real_escape_string($connect, $_POST['city']);
$country = mysqli_real_escape_string($connect, $_POST['country']);
$profession = mysqli_real_escape_string($connect, $_POST['profession']);
$skill_teach = mysqli_real_escape_string($connect, $_POST['skill_teach']);
$skill_learn = mysqli_real_escape_string($connect, $_POST['skill_learn']);
$about = mysqli_real_escape_string($connect, $_POST['about']);

$update_fields = "
    first_name = '{$fname}',
    last_name = '{$lname}',
    email = '{$email}',
    teach_skills = '{$skill_teach}',
    learn_skills = '{$skill_learn}',
    city = '{$city}',
    country = '{$country}',
    profession = '{$profession}',
    about = '{$about}'
";

if ($profile_photo_name != "") {
    $update_fields .= ", profile_photo = '{$profile_photo_name}'";
}

if ($cover_photo_name != "") {
    $update_fields .= ", cover_photo = '{$cover_photo_name}'";
}

$sql = "UPDATE users SET $update_fields WHERE id = {$user_id}";

if (mysqli_query($connect, $sql)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Update failed: " . mysqli_error($connect);
}
