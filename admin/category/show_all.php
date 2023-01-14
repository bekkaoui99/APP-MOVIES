<?php
session_start();
if (!$_SESSION['admin_logged_in']) {
    header('Location:../../user/index.php');
}
require('../../db/db.php');


$items_per_page = 3;
// Get the total number of items in the database
$total_items_query = $connection->prepare("SELECT COUNT(*) as total FROM categories");
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
$query = $connection->prepare("SELECT * FROM categories LIMIT $items_per_page OFFSET $offset");
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Search'])) {
        $query = $connection->prepare("SELECT * FROM categories  WHERE name LIKE :name LIMIT $items_per_page OFFSET $offset");
        $query->bindValue(':name', '%' . $_POST['Search_category'] . '%');
        $query->execute();
        $total_items = $query->fetchAll(PDO::FETCH_ASSOC);
    }
}





// $sql = "select * from categories";
// $all = $connection->prepare($sql);
// $all->execute();



function displayArrayAsTable($array)
{
    global $total_pages;
    echo '<div class="container mt-5">';
    echo '<div class="row">';
    echo '<div class="col-md-12">';

    echo  '<div class="card box_shadow">';
    echo '<div class="card-header bg-info text-white">';
    echo  '<h1 class="text-center">show all categorys</h1>';
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
    echo '<nav class="d-flex justify-content-between mb-2">
            <a class="btn btn-outline-primary"  type="button" href="add_category.php">new category</a>
            <form class="form-inline" method="post" action="show_all.php">
                 <input class="form-control mr-sm-2" type="search" name="Search_category" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" name="Search" type="submit">Search</button>
            </form>
          </nav>';
    echo '<table class="table table-bordered  table-hover">';
    foreach ($array as $row) {
        echo '<tr>';
        foreach ($row as $key => $value) {
            if ($key == "updated_at") {
                continue;
            }
            echo '<td>' . $key . '</td>';
        }
        echo '<td>ACTION</td>';


        break;
        echo '</tr>';
    }



    foreach ($array as $data) {
        echo '<tr>';

        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $created_at = $data['created_at'];


        echo '<td>' . $id . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $description . '</td>';
        echo '<td>' . $created_at . '</td>';


        echo "<td class='d-flex justify-content-center'>
        <a  class='btn btn-outline-primary update-button' href='update_category.php?id=" . $id . "'>update</a>
        <a  class='btn btn-outline-danger delete-button ml-2' href='delete_category.php?id=" . $id . "'>delete</a> 
        
        </td>";
        echo '</tr>';
    }


    echo '</div></div></div></table>';
?>

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
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>category</title>
    <style>
        .box_shadow {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }
    </style>
</head>

<body>
    <?php
    require('../navBar/navBar.php');
    ?>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        displayArrayAsTable($total_items);
    } else {
        displayArrayAsTable($data);
    }

    ?>




    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>

</html>