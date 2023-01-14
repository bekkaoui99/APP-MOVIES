<?php
session_start();
require('../db/db.php');

$sql_email = "select email from users ";
$select_emails = $connection->prepare($sql_email);

$select_emails->execute();
$data = $select_emails->fetchAll(PDO::FETCH_ASSOC);



$arry_erreurs = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['name']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['c_password'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

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

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Display an error message if the email is invalid
            $error_message = "Invalid email address.";
            $arry_erreurs['email'] = $error_message;
            $email = "";
        } elseif (empty($email)) {
            $error_message = "Please enter a email.";
            $arry_erreurs['email'] = $error_message;
            $email = "";
        } else {
            $email = trim($email);
        }


        foreach ($data as $email_validation) {
            if ($email_validation['email'] == $email) {
                $error = "That email is already in use.";
                $arry_erreurs['email'] = $error;
                $email = "";
            }
        }


        // Validate the password
        if (strlen($password) < 8) {
            // Display an error message if the password is too short
            $error_message = "Password must be at least 8 characters long.";
            $arry_erreurs['password'] = $error_message;
            $password = "";
        } elseif (empty($password)) {
            $error_message = "Please enter a password.";
            $arry_erreurs['password'] = $error_message;
            $password = "";
        } else {
            $password = trim($password);
        }

        if (strlen($c_password) < 8) {
            // Display an error message if the password is too short
            $error_message = "Password must be at least 8 characters long.";
            $arry_erreurs['c_password'] = $error_message;
            $c_password = "";
        } elseif (empty($password)) {
            $error_message = "Please enter a password.";
            $arry_erreurs['c_password'] = $error_message;
            $c_password = "";
        } elseif (strlen($password) != strlen($c_password)) {
            $error_message = "the password not match  .";
            $arry_erreurs['c_password'] = $error_message;
            $c_password = "";
        } else {
            $c_password = trim($c_password);
        }





        if (!empty($password)  and !empty($c_password) and !empty($name) and !empty($email)) {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $insertUser = $connection->prepare($sql);
            $insertUser->bindValue(':name', $name);
            $insertUser->bindValue(':email', $email);
            $insertUser->bindValue(':password', $password);

            // Execute the statement
            $insertUser->execute();

            if ($insertUser->rowCount() > 0) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_logged_in_name'] = $name;
                header('location:index.php?valid=user is added successfully');
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
<style>
    .box_shadow {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
    }
</style>

<body>

    <?php
    require('navBar.php');
    ?>




    <!-- Registration form -->
    <div class="container col-7 mt-5 mb-5 ">


        <div class="card box_shadow">

            <div class="card-header">
                <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
            </div>
            <div class="card-body">



                <form method="post" autocomplete="off">
                    <?php
                    global $arry_erreurs;
                    if (isset($arry_erreurs) and !empty($arry_erreurs)) {

                        echo ' <div class="alert alert-warning alert-dismissible fade show " role="alert">
                                    <strong>warning</strong> ';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                    }

                    ?>
                    <div class="form-group">
                        <label for="titre">name</label>
                        <input type="text" class="form-control" id="titre" name="name" placeholder="write the name" value="<?php if (isset($_POST['name'])) {
                                                                                                                                echo $_POST['name'];
                                                                                                                            } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['name']) and !empty($arry_erreurs['name'])) {
                                echo $arry_erreurs['name'];
                            } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="resume">email</label>
                        <input type="text" class="form-control" id="resume" placeholder="write the " name="email" value="<?php if (isset($_POST['email'])) {
                                                                                                                                echo $_POST['email'];
                                                                                                                            } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['email']) and !empty($arry_erreurs['email'])) {
                                echo $arry_erreurs['email'];
                            } ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="resume">password</label>
                        <input type="password" class="form-control" id="resume" placeholder="write the " name="password" value="<?php if (isset($_POST['password'])) {
                                                                                                                                    echo $_POST['password'];
                                                                                                                                } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['password']) and !empty($arry_erreurs['password'])) {
                                echo $arry_erreurs['password'];
                            } ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="resume">confirmation password</label>
                        <input type="password" class="form-control" id="resume" placeholder="write the " name="c_password" value="<?php if (isset($_POST['c_password'])) {
                                                                                                                                        echo $_POST['c_password'];
                                                                                                                                    } ?>">
                        <div class="text-danger">
                            <?php if (isset($arry_erreurs['c_password']) and !empty($arry_erreurs['c_password'])) {
                                echo $arry_erreurs['c_password'];
                            } ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>



            </div>







        </div>



        <!-- Bootstrap JavaScript -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>