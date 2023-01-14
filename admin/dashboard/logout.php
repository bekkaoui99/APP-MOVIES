<?php

session_start();
$_SESSION['admin_logged_in'] = null;
$_SESSION['admin_logged_in_name'] = null;
header('Location:../../user/index.php');
