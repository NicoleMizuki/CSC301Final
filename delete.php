<?php
session_start();
require_once('pdo.php');
deleteaccount($pdo,[$_SESSION['userID']]);
?>