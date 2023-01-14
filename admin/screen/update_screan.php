<?php

session_start();
if (!$_SESSION['admin_logged_in']) {
    header('Location:../../user/index.php');
}

require('../../db/db.php');
$arry_erreurs = array();
$sql = "select * from salles where id = :id";
$all = $connection->prepare($sql);
if (isset($_POST['id']) and !empty($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = $_GET['id'];
}
$all->bindValue(':id', $id);
$all->execute();

$data = $all->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['name']) and isset($_POST['place'])) {
        $name = $_POST['name'];
        $place = $_POST['place'];
        $id = $_POST['id'];



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

        if (empty($place)) {
            $error = "Please enter the number of place.";
            $arry_erreurs['place'] = $error;
            $place = "";
        } else if (!is_numeric($place)) {
            $error = "Please enter a valid number of place .";
            $arry_erreurs['place'] = $error;
            $place = "";
        } else {
            $place = trim($place);
        }





        if (!empty($name) and !empty($place)) {

            $sql_s = " UPDATE salles SET name = :name , place = :place WHERE id = :id ";

            // Prepare the statement
            $updateScrean = $connection->prepare($sql_s);

            $updateScrean->bindValue(':id', $id);
            $updateScrean->bindValue(':name', $name);
            $updateScrean->bindValue(':place', $place);


            // Execute the statement
            $updateScrean->execute();

            if ($updateScrean->rowCount() > 0) {
                header('location:show_all.php?valid=data is updated successfully');
            } else {
                $erreur = "data is not updated successfully";
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
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/styel.css">
    <title>update screan</title>
</head>

<body>
    <?php require('../navBar/navBar.php'); ?>


    <div class="center">
        <div class="card box_shadow">

            <div class="card-header bg-info text-white">
                <h1 class="h3 mb-3 font-weight-normal">form update screan</h1>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">

                    <?php

                    if (isset($arry_erreurs) and !empty($arry_erreurs) or (isset($erreur) and !empty($erreur))) {

                        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>warning</strong> ';
                        if (isset($erreur) and !empty($erreur)) {
                            echo $erreur;
                        }
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>';
                    }

                    ?>
                    <input type="hidden" value="<?php echo $data[0]['id']; ?>" name="id">
                    <div class="form-group">
                        <label for="titre">name</label>
                        <input type="text" class="form-control" id="titre" name="name" placeholder="Enter Titre" value="<?php if (isset($_POST['name'])) {
                                                                                                                            echo $_POST['name'];
                                                                                                                        } else {
                                                                                                                            echo $data[0]['name'];
                                                                                                                        } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['name']) and !empty($arry_erreurs['name'])) {
                                echo $arry_erreurs['name'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="titre">place</label>
                        <input type="number" class="form-control" id="titre" name="place" placeholder="Enter Titre" value="<?php if (isset($_POST['place'])) {
                                                                                                                                echo $_POST['place'];
                                                                                                                            } else {
                                                                                                                                echo $data[0]['place'];
                                                                                                                            } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['place']) and !empty($arry_erreurs['place'])) {
                                echo $arry_erreurs['place'];
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