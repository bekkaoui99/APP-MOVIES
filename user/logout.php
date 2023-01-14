<?php

session_start();
$_SESSION['user_logged_in'] = null;
$_SESSION['user_logged_in_name'] = null;
header('location:index.php');
