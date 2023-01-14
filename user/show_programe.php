<?php
session_start();



require('../db/db.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}



$select_film = $connection->prepare("SELECT * FROM Films where id=:id");
$select_film->bindParam(':id', $id);
$select_film->execute();
$data_f = $select_film->fetchAll(PDO::FETCH_ASSOC);



$select_programe = $connection->prepare("SELECT DISTINCT p.date  , p.id FROM programmes as p where p.films_id =:id");
$select_programe->bindParam(':id', $id);
$select_programe->execute();
$data_p = $select_programe->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Search'])) {
        $query = $connection->prepare("SELECT p.time , p.id , p.films_id  from programmes as p WHERE p.date = :date and p.films_id = :id");
        $query->bindValue(':date', $_POST['date']);
        $query->bindValue(':id', $id);
        $query->execute();
        $total_items = $query->fetchAll(PDO::FETCH_ASSOC);
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





<section class="articles">



    <div class="container">

        <div class="row_article_programe">



            <div class="card_article">
                <div class="img_article">
                    <img src="<?php echo $data_f[0]["image"]; ?>" alt="">
                </div>


                <div class="info_article">
                    <h2><?php echo $data_f[0]["name"]; ?></h2>
                    <p><?php echo $data_f[0]["description"]; ?> </p>

                </div>



            </div>

            <div class="programe">


                <?php if (!empty($data_p)) { ?>
                    <form method="post" class="d-flex justify-content-end">
                        <div class="form-group">

                            <select class="custom-select my-1 mr-sm-2" name="date" id="inlineFormCustomSelectPref">
                                <?php
                                foreach ($data_p as $row) {
                                    $date = $row['date'];
                                    $date_programe = $row['date'];


                                    if (isset($_POST['date'])) {
                                        echo "<option selected value=" . $_POST['date'] . ">" . $_POST['date'] . "</option>";
                                    } else {
                                        echo "<option value='$date'>$date_programe</option>";
                                    }
                                }

                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <button class="btn btn-outline-success my-1 mr-sm-2" name="Search" type="submit">Search</button>
                        </div>

                    </form>
                <?php } else {
                    echo ' <ul class="list-group">';
                    echo '  <li class="list-group-item active text-center">there is not a program about thid movie </li>';

                    echo '  </ul>';
                } ?>

                <?php if (isset($total_items)) { ?>
                    <div class="list-group">
                        <h4 href="#" class="list-group-item list-group-item-action active">
                            time of this date
                        </h4>
                        <?php
                        foreach ($total_items as $time) { ?>
                            <a <?php $id = $time['id'];
                                $film_id = $time['films_id'];
                                echo "href=reservation.php?id=$id&film=$film_id"; ?> class="list-group-item list-group-item-action"><?php echo $time['time']; ?></a>
                        <?php  }
                        ?>

                    </div>
                <?php  }
                ?>

            </div>

        </div>








    </div>

</section>




</html>