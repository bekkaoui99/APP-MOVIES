<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>Document</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="">MOVIE TICKET</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Product menu -->
            <ul class="navbar-nav mr-auto">


                <li class="nav-item">
                    <a class="nav-link" href="../film/show_all_films.php">movie</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../category/show_all.php">category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../screen/show_all.php">screan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../programme/show_all.php">programme</a>
                </li>
            </ul>
            <!-- Login and register menu -->
            <ul class="navbar-nav">
                <li class="nav-item">

                    <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) {
                        echo "<li class'nav-link'><a class='nav-link' href='../dashboard/logout.php'>logout</a></li>";
                    } else {
                        echo "<li class'nav-link'><a class='nav-link' href='../index.php'>Login</a></li>";
                    }
                    ?>
                </li>
                <?php if (isset($_SESSION['admin_logged_in_name'])) {

                    echo "  <li class='ml-3 pl-4 pr-4 nav-item border border-primary rounded bg-info'>
                            <a class='nav-link text-white' href=''>" . $_SESSION['admin_logged_in_name'] . "</a>
                            </li>";
                } else {

                    echo "  <li class='nav-item'>
                    <a class='nav-link' href='register.php'>Register</a>
                    </li>";
                } ?>

            </ul>
        </div>
    </nav>


    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>

</html>