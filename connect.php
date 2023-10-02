<?php
$strConnection = mysqli_connect('localhost', 'root', '6451389', 'w3cms');
if (!$strConnection) {
  die('Can not connect');
}
mysqli_set_charset($strConnection, 'utf8');
