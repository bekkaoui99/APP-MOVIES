<?php

session_start();
if (!$_SESSION['user_logged_in']) {
    header('Location:login.php');
}

require('../db/db.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $film_id = $_GET['film'];
}

$select_film = $connection->prepare("SELECT f.name FROM Films as f where f.id=:id");
$select_film->bindParam(':id', $film_id);
$select_film->execute();
$data_f = $select_film->fetchAll(PDO::FETCH_ASSOC);


$select_user = $connection->prepare("SELECT id FROM users  where name =:name");
$select_user->bindParam(':name', $_SESSION['user_logged_in_name']);
$select_user->execute();
$data_user = $select_user->fetchAll(PDO::FETCH_ASSOC);

$select_price = $connection->prepare("SELECT p.prix FROM programmes as p where p.id= :id");
$select_price->bindParam(':id', $id);
$select_price->execute();
$data_prive = $select_price->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    if (isset($_POST['ticket']) and isset($_POST['total'])) {



        $ticket = $_POST['ticket'];
        $total = $_POST['total'];



        if (!empty($ticket) and !empty($total)) {

            $sql_reservation = "INSERT INTO reservations( programmes_id , users_id, N_ticket, total_p , created_at) values (:p_id , :user_id , :ticket , :total , :created_at) ";

            // Prepare the statement
            $insert_reservation = $connection->prepare($sql_reservation);

            // Bind the values to the placeholders
            $insert_reservation->bindValue(':p_id', $id);
            $insert_reservation->bindValue(':user_id', $data_user[0]['id']);
            $insert_reservation->bindValue(':ticket', $ticket);
            $insert_reservation->bindValue(':total', $total * $ticket);
            $date = new DateTime();
            $insert_reservation->bindValue(':created_at', $date->format('Y-m-d H:i:s'));

            $insert_reservation->execute();


            if ($insert_reservation->rowCount() > 0) {
                $_SESSION['insert_reservation'] = true;
                header('location:show_all_film.php?valid=data is added');
            }
        }
    }
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

</body>

<?php
require('navBar.php');
?>


<div class="container col-8 mt-5 mb-5 ">


    <div class="card box_shadow">

        <div class="card-header bg-info text-white">
            <h1 class="h3 mb-3 font-weight-normal">reservation</h1>
        </div>
        <div class="card-body">



            <form method="post" autocomplete="off" enctype="multipart/form-data">


                <?php

                if (isset($arry_erreurs) and !empty($arry_erreurs)) {

                    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>warning</strong> ';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                   </div>';
                }

                ?>



                <div class="form-group">
                    <label for="titre">movie</label>
                    <input type="text" readonly class="form-control" id="movie" name="movie" placeholder="movie" value="<?php echo $data_f[0]['name']; ?>">
                </div>

                <div class="form-group">
                    <label for="annee">user name</label>
                    <input type="text" readonly class="form-control" id="name" name="name" placeholder="user name" value="<?php echo $_SESSION['user_logged_in_name']; ?>">

                </div>

                <div class="form-group">
                    <label for="duré">ticket</label>
                    <input type="number" class="form-control" id="ticket" name="ticket" placeholder="Enter le number od the ticket">

                </div>

                <div class="form-group">
                    <label for="resume">total</label>
                    <input type="number" readonly class="form-control" id="total" name="total" value="<?php echo $data_prive[0]['prix']; ?>">

                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
            </form>


        </div>
    </div>
</div>




</html>