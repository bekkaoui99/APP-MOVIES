<?php
session_start();
require('../db/db.php');



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











    <main>

        <section class="landing">

            <div class="container row_landing">


                <div class="info_landing">
                    <h2>Welcome to MovieTicket</h2>
                    <p>
                        We are committed to providing the best movie-going experience possible, which is why we offer a variety of ticket types to suit your needs. From standard 2D tickets to 3D and IMAX showings, we have it all. Plus, our mobile ticketing option allows you to purchase tickets and reserve your seats from your phone or tablet.
                    </p>
                </div>



                <div class="img_landing">

                    <img src="../images/youtube.png" alt="">
                </div>








            </div>

            <div class="down">

                <a href="">
                    <i class="fa-solid fa-turn-down"></i>
                </a>
            </div>


        </section>






        <section class="state">


            <h2 class="title_state">Our Awesome Stats</h2>




            <div class="container row_state">

                <div class="card_state">
                    <i class="fa-solid fa-user"></i>
                    <h2>850</h2>
                    <p>client</p>
                </div>


                <div class="card_state">
                    <i class="fa-solid fa-clapperboard"></i>
                    <h2>950</h2>
                    <p>movies</p>
                </div>


                <div class="card_state">
                    <i class="fa-solid fa-earth-africa"></i>
                    <h2>20</h2>
                    <p>contrais</p>
                </div>



                <div class="card_state">
                    <i class="fa-solid fa-ticket"></i>
                    <h2>8950</h2>
                    <p>ticket</p>
                </div>


            </div>



        </section>





        <section class="descount">



            <div class="row_descount">



                <div class="info_descount">

                    <h2>we have a descount</h2>

                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi asperiores consectetur,
                        recusandae ratione provident necessitatibus, cumque delectus commodi fuga praesentium beatae.
                        Totam vel similique laborum dicta aperiam odit doloribus corporis.
                    </p>


                    <img src="../images/discount.png" alt="">

                </div>



                <div class="form_descount">



                    <h2>send a requiste</h2>

                    <form action="">



                        <input type="text" placeholder="your name">

                        <input type="email" placeholder="your mail">

                        <input type="text" placeholder="your phone">

                        <textarea placeholder="tell us about you need"></textarea>


                        <input class="btn" type="button" value="send">







                    </form>







                </div>











            </div>







        </section>





    </main>





    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>