<?php
require './connect.php';

if (isset($_POST['username'])) $username = $_POST['username'];
if (isset($_POST['password'])) $password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$dob = $_POST['dob'];
if (isset($_POST['roles'])) {
  $roleValue = $_POST['roles'];
  $role = '';
  switch ($roleValue) {
    case 'role1':
      $role = 'Manager';
      break;
    case 'role2':
      $role = 'Customer';
      break;
    default:
      $role = 'Unknown';
      break;
  }
}

if (isset($_POST['gender'])) {
  $genderValue = $_POST['gender'];
  $gender = '';
  switch ($genderValue) {
    case 'gender1':
      $gender = 'Male';
      break;
    case 'gender2':
      $gender = 'Female';
      break;
    default:
      $gender = 'Others';
      break;
  }
}

$image = './assets/images/customer.jpg';

$status = $_POST['status'];
$status ? $status = 1 : $status = 0;

$query = "insert into w3cms_users (username, password, first_name, last_name, email, phone_number, role, gender, dob, image, stt) values 
('$username', '$password', '$first_name', '$last_name', '$email', '$phone_number', '$role', '$gender', '$dob', '$image', $status);";

mysqli_query($strConnection, $query);

mysqli_close($strConnection);

header("Location: index.php");
