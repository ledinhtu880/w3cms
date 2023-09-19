<?php
require './connect.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

$query = "delete from w3cms_users where id = $id";
mysqli_query($strConnection, $query);

mysqli_close($strConnection);

header("Location: index.php");
