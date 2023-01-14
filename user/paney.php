<?php

session_start();
require('../db/db.php');

$sql = "SELECT r.programmes_id FROM reservations as r 
INNER JOIN users as u
on u.id = r.users_id
where u.name = :name";
$select_id = $connection->prepare($sql);
$select_id->bindParam(':name', $_SESSION['user_logged_in_name']);
$select_id->execute();
$data_id = $select_id->fetchAll(PDO::FETCH_ASSOC);


$sql_all = "SELECT * , r.id FROM reservations as r inner join programmes as p on p.id = r.programmes_id
 INNER JOIN films as f on p.films_id = f.id";
$select_reservation = $connection->prepare($sql_all);
// $select_reservation->bindValue(':id', $data_id[0]['programmes_id']);
$select_reservation->execute();
$data_reservation = $select_reservation->fetchAll(PDO::FETCH_ASSOC);







function displayArrayAsTable($array)
{


    echo '<div class="container mt-5 mb-5">';
    echo '<div class="row">';
    echo '<div class="col-md-12">';

    echo  '<div class="card box_shadow">';
    echo '<div class="card-header bg-info text-white">';
    echo  '<h1 class="text-center">show all reservation</h1>';
    echo '</div>';
    echo '<div class="card-body">';
    if (isset($_GET['valid'])) {
        echo '<div class="mt-2">';
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>success</strong> ';
        echo $_GET['valid'];
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        echo '</div>';
    }

    echo '<table class="table table-hover">';

    echo '<tr class="bg-white text-info">';

    echo '<td>#</td>';
    echo '<td>film</td>';
    echo '<td>date</td>';
    echo '<td>time</td>';
    echo '<td>duration</td>';
    echo '<td>number of ticket</td>';
    echo '<td>price</td>';
    echo '<td>ACTION</td>';



    echo '</tr>';



    foreach ($array as $data) {
        echo '<tr>';

        $id = $data['id'];
        $name = $data['name'];
        $date = $data['date'];
        $time = $data['time'];
        $duration = $data['duree'];
        $N_ticket = $data['N_ticket'];
        $total_p = $data['total_p'];
        $_SESSION['users_id'] = $data['users_id'];


        echo '<td>' . $id . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $date . '</td>';
        echo '<td>' . $time . '</td>';
        echo '<td>' . $duration . '</td>';
        echo '<td>' . $N_ticket . '</td>';
        echo '<td>' . $total_p . '</td>';

        $user_id = $_SESSION['users_id'];
        echo "<td class='d-flex justify-content-center'>
       
         <a  class='btn btn-outline-primary update-button' href='update_film.php?id=$id'>update</a>
         <a  class='btn btn-outline-danger delete-button ml-2' href='delete_reservation.php?id=$id' >delete</a> 
         
         </td>";


        echo '</tr>';
    }


    echo '</div></div></div></table>';
?>
    <nav class="d-flex justify-content-end mt-3 mr-5">
        <a class="btn btn-outline-danger mr-2" <?php echo "href=clear_r.php?id=$user_id"; ?> type="button">clear all</a>
        <a class="btn btn-outline-primary pl-4 pr-4" <?php echo "href=payment.php?id=$user_id"; ?> type="button">pays</a>
    </nav>

<?php
    echo '</div>';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel=" preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../css/styel.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>

    <?php
    require('navBar.php');
    ?>

    <?php
    if (isset($data_reservation)) {

        displayArrayAsTable($data_reservation);
    }
    ?>

</body>

</html>