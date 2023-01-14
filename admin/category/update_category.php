<?php

session_start();
if (!$_SESSION['admin_logged_in']) {
    header('Location:../../user/index.php');
}

require('../../db/db.php');
$array_erreurs = array();
$sql = "select * from categories where id = :id";
$all = $connection->prepare($sql);
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id = $_GET['id'];
}
$all->bindValue(':id', $id);
$all->execute();

$data = $all->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['description']) and isset($_POST['name'])) {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        if (empty($name)) {
            $error = "Please enter a name.";
            $arry_erreurs['name'] = $error;
            $name = "";
        } else if (!preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
            $error = "Please enter a valid name.";
            $arry_erreurs['name'] = $error;
            $name = "";
        } else {
            $name = trim($name);
        }

        if (empty($description)) {
            $error = "Please enter a description.";
            $arry_erreurs['description'] = $error;
            $description = "";
        } else if (!preg_match("/^[a-zA-Z-'\s]+$/", $description)) {
            $error = "Please enter a valid description.";
            $arry_erreurs['description'] = $error;
            $description = "";
        } else {
            $description = trim($description);
        }



        if (!empty($name) and !empty($description)) {

            $sql_c = "UPDATE categories SET name = :name , description = :description  WHERE id = :id";


            // Prepare the statement
            $insertCategory = $connection->prepare($sql_c);

            // Bind the values to the placeholders
            $insertCategory->bindParam(':id', $id);
            $insertCategory->bindParam(':name', $name);
            $insertCategory->bindParam(':description', $description);


            // Execute the statement
            $insertCategory->execute();

            if ($insertCategory->rowCount() > 0) {
                header('location:show_all.php?valid=data is updated successfully');
            } else {
                $erreur = 'data is not updated successfully';
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
    <title>add category</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/styel.css">
</head>

<body class="bg-light">
    <?php
    require('../navBar/navBar.php');
    ?>




    <div class="center">
        <div class="card box_shadow">

            <div class="card-header bg-info text-white">
                <h1 class="h3 mb-3 font-weight-normal">form update category</h1>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">

                    <?php

                    if (isset($array_erreurs) and !empty($array_erreurs) or (isset($erreur) and !empty($erreur))) {
                        echo '<div class="container">';
                        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>warning</strong> ';
                        if (isset($erreur) and !empty($erreur)) {
                            echo $erreur;
                        }
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                        echo '</div>';
                    }
                    ?>

                    <input type="hidden" value="<?php echo $data[0]['id']; ?>" name="id">
                    <div class="form-group">
                        <label for="titre">name</label>
                        <input type="text" value="<?php if (isset($_POST['name'])) {
                                                        echo $_POST['name'];
                                                    } else {
                                                        echo $data[0]['name'];
                                                    } ?>" class="form-control" id="titre" name="name" placeholder="write the name">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['name']) and !empty($arry_erreurs['name'])) {
                                echo $arry_erreurs['name'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="resume">description</label>
                        <input class="form-control" value="<?php if (isset($_POST['description'])) {
                                                                echo $_POST['description'];
                                                            } else {
                                                                echo $data[0]['description'];
                                                            } ?>" id="resume" name="description" placeholder="write the desc">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['description']) and !empty($arry_erreurs['description'])) {
                                echo $arry_erreurs['description'];
                            } ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>








    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>