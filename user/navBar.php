<?php

require('../db/db.php');

$sql = "SELECT count(*) FROM reservations as r inner join users as u on u.id = r.users_id where u.name = :name ";
$select_reservation = $connection->prepare($sql);
$select_reservation->bindParam(':name', $_SESSION['user_logged_in_name']);
$select_reservation->execute();
$number = $select_reservation->fetchColumn();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>
</head>



<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">MOVIE TICKET</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Product menu -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="show_All_Film.php">ALL MOVIES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="coming_soon.php">COMING SOON</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="today_show.php">TODAT SHOW</a>
                </li>

            </ul>
            <!-- Login and register menu -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?php if (isset($_SESSION['insert_reservation']) and $number > 0) {
                        echo "<li class'nav-link '><a class='nav-link pl-4 pr-4 border-primary rounded bg-info text-white' href='paney.php'><i class='fi fi-sr-shopping-cart'></i> " . $number . "</a></li>";
                    }  ?>
                    <?php if (isset($_SESSION['user_logged_in_name'])) {

                        echo "  <li class='ml-1 nav-item border pl-4 pr-4 border-primary rounded bg-info'>
                        <a class='nav-link text-white' href=''>" . $_SESSION['user_logged_in_name'] . "</a>
                        </li>";
                    } else {

                        echo "  <li class='nav-item'>
                        <a class='nav-link' href='register.php'>Register</a>
                        </li>";
                    } ?>

                    <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {

                        echo "  <li class='ml-1 nav-item border pl-4 pr-4 border-primary rounded bg-info'>
                        <a class='nav-link text-white' href='logout.php'>logout</a></li>";
                    } else {
                        echo "<li class'nav-link '><a class='nav-link' href='login.php'>Login</a></li>";
                    }
                    ?>
                </li>

            </ul>
        </div>
    </nav>



</body>

</html>