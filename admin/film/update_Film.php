<?php

session_start();
if (!$_SESSION['admin_logged_in']) {
    header('Location:../../user/index.php');
}

require('../../db/db.php');

$arry_erreurs = array();
$sql_c = "select * from categories";
$all_category  = $connection->prepare($sql_c);

$all_category->execute();

$data_c = $all_category->fetchAll();


$sql = "select * from films where id = :id";
$film  = $connection->prepare($sql);

$film->bindValue(':id',  $_GET['id']);



$film->execute();

$data = $film->fetchAll(PDO::FETCH_ASSOC);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['name']) and isset($_POST['description']) and isset($_POST['annee']) and isset($_POST['duree']) and isset($_POST['category'])) {

        $id = $_POST['id'];
        $annee = $_POST['annee'];
        $duree = $_POST['duree'];
        $category = $_POST['category'];
        $projection = $_POST['projection'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image_url = $_POST['image'];


        // $file_name = $_FILES['image']['name'];
        // $file_type = $_FILES['image']['type'];
        // $file_tmp  = $_FILES['image']['tmp_name'];
        // $file_size = $_FILES['image']['size'];


        // Check the file type
        // $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        // if (!in_array($file_type, $allowed_types)) {
        //     $error = "anvalid file extension";
        //     $arry_erreurs['image'] = $error;
        //     $file_name = "";
        // }


        if (empty($image_url)) {
            $error = "Please write the image URL.";
            $arry_erreurs['image'] = $error;
            $image_url = "";
        } elseif (!filter_var($image_url, FILTER_VALIDATE_URL)) {
            $error = "URL is not valid.";
            $arry_erreurs['image'] = $error;
            $image_url = "";
        } else {
            $image_url = trim($image_url);
        }


        // Check the file category
        if (empty($category)) {
            $error = "Please select a category.";
            $arry_erreurs['category'] = $error;
            $category = "";
        }

        //validation duree and annee
        if (empty($annee)) {
            $error = "Please enter a year.";
            $arry_erreurs['annee'] = $error;
            $annee = "";
        } else if (!is_numeric($annee)) {
            $error = "Please enter a valid year.";
            $arry_erreurs['annee'] = $error;
            $annee = "";
        } else {
            $annee = trim($annee);
        }

        //validation duree and annee
        if (empty($duree)) {
            $error = "Please enter a time.";
            $arry_erreurs['duree'] = $error;
            $duree = "";
        } else if (!is_numeric($annee)) {
            $error = "Please enter a valid time.";
            $arry_erreurs['duree'] = $error;
            $duree = "";
        } else {
            $duree = trim($duree);
        }

        //validation name
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

        //validation description 
        if (empty($description)) {
            $error = "Please enter a description.";
            $arry_erreurs['description'] = $error;
            $description = "";
        } else {
            $description = trim($description);
        }

        // Save the file to the server
        // move_uploaded_file($file_tmp, '../../images/' . $file_name);



        if (!empty($image_url) and !empty($category) and !empty($name) and !empty($duree)  and !empty($annee) and !empty($description)) {


            $sql_f = "UPDATE  films SET name = :name , description = :description , duree = :duree, anne = :anne, projection = :projection, categories_id = :categories_id , image = :image  where id = :id";


            // Prepare the statement
            $insertFilm = $connection->prepare($sql_f);

            // Bind the values to the placeholders
            $insertFilm->bindValue(':id', $id);
            $insertFilm->bindValue(':name', $name);
            $insertFilm->bindValue(':description', $description);
            $insertFilm->bindValue(':duree', $duree);
            $insertFilm->bindValue(':anne', $annee);
            $insertFilm->bindValue(':projection', $projection);
            $insertFilm->bindValue(':categories_id', $category);
            $insertFilm->bindValue(':image', $image_url);


            // Execute the statement
            $insertFilm->execute();

            if ($insertFilm->rowCount() > 0) {
                header('location:show_all_films.php?valid=data is updated successfully');
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
    <title>update film</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .box_shadow {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        }
    </style>
</head>

<body>
    <?php
    require('../../admin/navBar/navBar.php');
    ?>




    <div class="container col-8 mt-5 mb-5 ">


        <div class="card box_shadow">

            <div class="card-header bg-info text-white">
                <h1 class="h3 mb-3 font-weight-normal">form add movie</h1>
            </div>
            <div class="card-body">



                <form method="post" autocomplete="off" enctype="multipart/form-data">

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
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">category</label>
                        <select class="custom-select my-1 mr-sm-2" name="category" id="inlineFormCustomSelectPref">
                            <option value="">select on category</option>
                            <?php
                            foreach ($data_c as $row) {
                                $id = $row['id'];
                                $service = $row['name'];
                                if ($data[0]['categories_id'] == $id) {
                                    echo "<option value='$id' selected>" . $service . "</option>";
                                } elseif (isset($_POST['category']) and $_POST['category'] == $id) {
                                    echo "<option value='$id' selected >$name</option>";
                                } else {
                                    echo "<option value='$id'>$service</option>";
                                }
                            }

                            ?>
                        </select>
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['category']) and !empty($arry_erreurs['category'])) {
                                echo $arry_erreurs['category'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="titre">titre</label>
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
                        <label for="annee">anne</label>
                        <input type="text" class="form-control" id="annee" name="annee" placeholder="Enter Annee" value="<?php if (isset($_POST['anne'])) {
                                                                                                                                echo $_POST['anne'];
                                                                                                                            } else {
                                                                                                                                echo $data[0]['anne'];
                                                                                                                            } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['annee']) and !empty($arry_erreurs['annee'])) {
                                echo $arry_erreurs['annee'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duré">duree</label>
                        <input type="number" class="form-control" id="duré" name="duree" placeholder="Enter le duree" value="<?php if (isset($_POST['duree'])) {
                                                                                                                                    echo $_POST['duree'];
                                                                                                                                } else {
                                                                                                                                    echo $data[0]['duree'];
                                                                                                                                } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['duree']) and !empty($arry_erreurs['duree'])) {
                                echo $arry_erreurs['duree'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="resume">description</label>
                        <input type="text" class="form-control" id="resume" name="description" value="<?php if (isset($_POST['description'])) {
                                                                                                            echo $_POST['description'];
                                                                                                        } else {
                                                                                                            echo $data[0]['description'];
                                                                                                        } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['description']) and !empty($arry_erreurs['description'])) {
                                echo $arry_erreurs['description'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="resume">Choose file</label>
                        <input class="form-control" id="image" name="image" value="<?php if (isset($_POST['image'])) {
                                                                                        echo $_POST['image'];
                                                                                    } else {
                                                                                        echo $data[0]['image'];
                                                                                    } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['image']) and !empty($arry_erreurs['image'])) {
                                echo $arry_erreurs['image'];
                            } ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="projection">projection</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input name="projection" <?php if ($data[0]['projection'] == 1) {
                                                                    echo 'checked';
                                                                } ?> value="1" type="radio" aria-label="Checkbox for following text input">
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with checkbox">
                        </div>
                        <label for="projection">en cours de projection</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input name="projection" <?php if ($data[0]['projection'] == 0) {
                                                                    echo 'checked';
                                                                } ?> value="0" type="radio" aria-label="Checkbox for following text input">
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with checkbox">
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