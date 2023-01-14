<?php
session_start();

require('../db/db.php');
$arry_erreurs = array();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['email']) and isset($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];


        // Validate the email
        if (empty($email)) {
            $error_message = "Please enter a email.";
            $arry_erreurs['email'] = $error_message;
            $email = "";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Display an error message if the email is invalid
            $error_message = "Invalid email address hh.";
            $arry_erreurs['email'] = $error_message;
            $email = "";
        } else {
            $email = trim($email);
        }


        // Validate the password
        if (empty($password)) {
            $error_message = "Please enter a password.";
            $arry_erreurs['password'] = $error_message;
            $password = "";
        } elseif (strlen($password) < 8) {
            // Display an error message if the email is invalid
            $error_message = "Password must be at least 8 characters long.";
            $arry_erreurs['password'] = $error_message;
            $password = "";
        } else {
            $password = trim($password);
        }


        if (!empty($email) and !empty($password)) {


            $sql = "SELECT * FROM users where email = :email and password = :password";

            $getUser = $connection->prepare($sql);
            $getUser->bindValue(':email', $email);
            $getUser->bindValue(':password', $password);
            // Execute the statement
            $getUser->execute();
            $data = $getUser->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                header('location:index.php?erreur=you rite the bad data');
                $_SESSION['logged_in'] = false;
            } else {
                if ($data[0]['isAdmin'] == 'admin') {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_logged_in_name'] = $data[0]['name'];
                    header('location:../admin/dashboard/dashbord.php');
                } else {
                    header('location:index.php');
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['user_logged_in_name'] = $data[0]['name'];
                }
            }
        }
    }
}

// if (isset($error_message)) {
//   // Display the error message and show the form again
//   echo $error_message;
//   include 'form.html';
// } else {
//   // The email and password are valid, so do something with them (e.g. log the user in)
//   // ...
// }





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





    <div class="center">
        <div class="card box_shadow">

            <div class="card-header">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            </div>
            <div class="card-body">
                <?php
                if (isset($arry_erreurs) and !empty($arry_erreurs)) {
                    echo '  <div class="alert alert-warning alert-dismissible fade show mx-auto text-center" role="alert">
                                 <strong>warning</strong> 
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                 </button>
                                  </div>';
                }
                ?>
                <form method="POST" autocomplete="off">


                    <label for="inputEmail" class="sr-only">login</label>
                    <input type="text" id="inputEmail" name="email" class="form-control mt-3 mb-2" autocomplete="off" placeholder="Email address" value="<?php if (isset($_POST['email'])) {
                                                                                                                                                                echo $_POST['email'];
                                                                                                                                                            } ?>">
                    <div class="text-danger">
                        <?php if (isset($arry_erreurs['email']) and !empty($arry_erreurs['email'])) {
                            echo $arry_erreurs['email'];
                        } ?>
                    </div>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control mb-2" autocomplete="off" placeholder="Password" value="<?php if (isset($_POST['password'])) {
                                                                                                                                                                echo $_POST['password'];
                                                                                                                                                            } ?>">
                    <div class="text-danger">
                        <?php if (isset($arry_erreurs['password']) and !empty($arry_erreurs['password'])) {
                            echo $arry_erreurs['password'];
                        } ?>
                    </div>
                    <div class="checkbox mb-3">
                        <label class="d-flex justify-content-left align-items-left">
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

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