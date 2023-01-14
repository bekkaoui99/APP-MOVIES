<?php

session_start();
if (!$_SESSION['user_logged_in']) {
    header('Location:login.php');
}
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cardNumber']) and isset($_POST['cardExpiry']) and  isset($_POST['cardCVV']) and  isset($_POST['amount'])) {

        $cardNumber = $_POST['cardNumber'];
        $cardExpiry = $_POST['cardExpiry'];
        $cardCVV = $_POST['cardCVV'];
        $amount = $_POST['amount'];


        // Validate card number
        if (empty($cardNumber)) {
            $errors['card_n'] = "write the  card number";
            $cardNumber = "";
        } elseif (!preg_match("/^[0-9]{16}$/", $cardNumber)) {
            $errors['card_n'] = "Invalid card number";
            $cardNumber = "";
        } else {
            $cardNumber = trim($cardNumber);
        }

        // Validate expiration date
        if (empty($cardExpiry)) {
            $errors['card_e'] = "write the expiration date";
            $cardExpiry = "";
        } elseif (!preg_match("/^(0[1-9]|1[0-2])\/[0-9]{2}$/", $cardExpiry)) {
            $errors['card_e'] = "Invalid expiration date";
            $cardExpiry = "";
        } else {
            $cardExpiry = trim($cardExpiry);
        }

        // Validate CVV
        if (empty($cardCVV)) {
            $errors['cardCVV'] = "write the CVV";
            $cardCVV = "";
        } elseif (!preg_match("/^[0-9]{3}$/", $cardCVV)) {
            $errors['cardCVV'] = "Invalid CVV";
            $cardCVV = "";
        } else {
            $cardCVV = trim($cardCVV);
        }

        // Validate amount
        if (empty($amount)) {
            $errors['amount'] = "write the amount";
            $amount = "";
        } elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $amount)) {
            $errors['amount'] = "Invalid amount";
            $amount = "";
        } else {
            $amount = trim($amount);
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

    <?php
    require('navBar.php');
    ?>


    <div class="container col-8 mt-5 mb-5 ">


        <div class="card box_shadow">

            <div class="card-header bg-info text-white">
                <h1 class="h3 mb-3 font-weight-normal">payment</h1>
            </div>
            <div class="card-body">

                <form method="post">
                    <?php

                    if (isset($errors) and !empty($errors)) {

                        echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>warning</strong> ';
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                    }

                    ?>
                    <div class="form-group">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" name="cardNumber" id="cardNumber" placeholder="Enter card number">
                        <div class="text-danger">
                            <?php if (isset($errors['card_n']) and !empty($errors['card_n'])) {
                                echo $errors['card_n'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardExpiry">Expiration Date</label>
                        <input type="text" class="form-control" name="cardExpiry" id="cardExpiry" placeholder="MM/YY">
                        <div class="text-danger">
                            <?php if (isset($errors['card_e']) and !empty($errors['card_e'])) {
                                echo $errors['card_e'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardCVC">CVC</label>
                        <input type="text" class="form-control" name="cardCVC" id="cardCVC" placeholder="CVC">
                        <div class="text-danger">
                            <?php if (isset($errors['cardCVV']) and !empty($errors['cardCVV'])) {
                                echo $errors['cardCVV'];
                            } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount">
                        <div class="text-danger">
                            <?php if (isset($errors['amount']) and !empty($errors['amount'])) {
                                echo $errors['amount'];
                            } ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                </form>


            </div>
        </div>
    </div>


</body>

</html>