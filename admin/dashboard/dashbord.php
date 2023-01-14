<?php
session_start();
if (!$_SESSION['admin_logged_in']) {
    header('Location:../../user/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>dashboard</title>
</head>

<body>
    <?php
    require('../navBar/navBar.php');
    ?>




</body>

</html>