<?php
session_start();


require('../db/db.php');



$items_per_page = 3;

// Get the total number of items in the database
$total_items_query = $connection->prepare("SELECT  count(DISTINCT p.films_id)  FROM films as f INNER JOIN programmes as p on f.id = p.films_id");
$total_items_query->execute();
$total_items = $total_items_query->fetchColumn();

// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);

// Get the current page number from the URL parameters, default to 1 if not set
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

// Calculate the offset for the LIMIT clause of the SQL query
$offset = ($current_page - 1) * $items_per_page;

// Set up the SQL query to get the items for the current page

$query = $connection->prepare("SELECT DISTINCT f.name , f.description ,f.image , f.id   FROM films as f INNER JOIN programmes as p on f.id = p.films_id where f.projection = 1 and p.date = :date  LIMIT $items_per_page OFFSET $offset");
$date = new DateTime();
$query->bindValue(':date', $date->format('Y-m-d'));
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Search'])) {
        $query = $connection->prepare("SELECT DISTINCT f.name , f.description ,f.image , f.id   FROM films as f INNER JOIN programmes as p on f.id = p.films_id where f.projection = 1 and p.date = :date LIMIT $items_per_page OFFSET $offset");

        $query->bindValue(':date', $_POST['Search_date']);
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


        <nav class="d-flex justify-content-between mb-4">
            <div></div>
            <form class="form-inline" method="post">
                <input class="form-control" type="date" name="Search_date" placeholder="Search" aria-label="Search" value="<?php if (isset($_POST['Search_date'])) {
                                                                                                                                echo $_POST['Search_date'];
                                                                                                                            } ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" name="Search" type="submit">Search</button>
            </form>
        </nav>
    </div>

    <div class="container row_article">

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($total_items as $data_f) {  ?>

                <div class="card_article">
                    <div class="img_article">
                        <img src="<?php echo $data_f["image"]; ?>" alt="">
                    </div>


                    <div class="info_article">
                        <h2><?php echo $data_f["name"]; ?></h2>
                        <p><?php echo $data_f["description"]; ?> </p>

                    </div>
                    <div class="more_info">
                        <span>read more</span>
                        <a <?php $id = $data_f['id'];
                            echo  "href=show_programe.php?id=$id"; ?>>
                            <i class="fa-solid fa-right-long"></i>
                        </a>
                    </div>


                </div>
            <?php }
        } else {
            foreach ($data as $data_f) {  ?>

                <div class="card_article">
                    <div class="img_article">
                        <img src="<?php echo $data_f["image"]; ?>" alt="">
                    </div>


                    <div class="info_article">
                        <h2><?php echo $data_f["name"]; ?></h2>
                        <p><?php echo $data_f["description"]; ?> </p>

                    </div>
                    <div class="more_info">
                        <span>read more</span>
                        <a <?php $id = $data_f['id'];
                            echo  "href=show_programe.php?id=$id"; ?>>
                            <i class="fa-solid fa-right-long"></i>
                        </a>
                    </div>


                </div>
        <?php }
        }

        ?>





    </div>

</section>
<?php if (!empty($total_items)) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href='?page=<?php if (isset($_GET['page']) and $_GET['page'] != 1) {
                                                        echo  $_GET['page'] - 1;
                                                    } else {
                                                        echo 1;
                                                    } ?>'>Previous</a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item"><a class="page-link" href='?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
            <?php  } ?>

            <li class="page-item">
                <a class="page-link" href='?page=<?php if (isset($_GET['page']) and $_GET['page'] != $total_pages) {
                                                        echo  $_GET['page'] + 1;
                                                    } else {
                                                        echo $total_pages;
                                                    }  ?>'>Next</a>
            </li>
        </ul>
    </nav>
<?php } ?>


</html>