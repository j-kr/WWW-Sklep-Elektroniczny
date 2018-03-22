<!DOCTYPE html>
<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Praca na 5">
    <meta name="author" content="Jakub Kruczkowski & Rafał Siwoń">

    <title>Sklep Elektroniczny</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Sklep Elektroniczny</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Strona domowa
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kontakt.php">O nas</a>
                </li>


                <?php
                session_start();
                include_once('polaczenie.php');
                @$x = $_SESSION['uzytkownik'];

                if (@$_SESSION['zalogowany']==true)	{?>

                <?php
                    $stmt = $pdo->query('SELECT IMIE, NAZWISKO from osoby where login = "'.$x.'"');
                    echo ' <li class="nav-item"><a class="nav-link" href="uzytkownik.php">Zalogowano jako: <B>'.$x.'</B></a>';
                }
                else {
                    echo ' <li class="nav-item"><a class="nav-link" href="zaloguj.php">Zaloguj</a>';
                }

                if (@$_SESSION['zalogowany']==true)	{

                    echo'</li>
                                <li class="nav-item">
                                    <a class="nav-link" href="wyloguj.php">Wyloguj</a>
                                </li>
                                </li>';}
                else{

                    echo'      </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="rejestracja.php">Rejestracja</a>
                                 </li>
                                 </li>';
                }

                ?>


            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <!--<h1 class="my-4">Kategoria</h1>
          <div class="list-group">
              <?php

            $stmt1 = $pdo->query('SELECT nazwa from typy');

            foreach($stmt1 as $row)
            {
                echo '<a href="#" class="list-group-item">'.$row['nazwa'].'</a>';
            }
            ?>
          </div>

            <div id="demo" class="list-group">
              <h1 class="my-4">Producent</h1>
                  <?php

            $stmt2 = $pdo->query('SELECT nazwa from producenci');

            foreach($stmt2 as $row)
            {
                echo '<a href="#" class="list-group-item">'.$row['nazwa'].'</a>';
            }
            ?>
              </div>-->

        </div>

        <!-- /.col-lg-3 -->

        <div style="width: 100%; text-align:center;"><br><br><br><br>


            <form action="zaloguj.php" method="POST">
                <div style="margin: 0 auto;">
                    <label for="login">Login: </label>
                    <input type="text" name="login"/>
                </div>
                <div style="margin: 0 auto;">
                    <label for="password">Hasło: </label>
                    <input type="password" name="password"/>
                </div>
                <button type="submit">Zaloguj</button>
            </form>
            <br><br><br><br>

            <?php


            @$login = $_POST['login'];
            @$password = $_POST['password'];
            $stmt = $pdo->query('SELECT ID, login, haslo, uprawnienie FROM osoby');
            foreach($stmt as $row)
            {
                if($login == $row['login'] and $password == $row['haslo']){
                    $_SESSION['zalogowany'] = true;
					$_SESSION['id_uzytkownik'] = $row['ID'];
					$_SESSION['poziom_uprawnienia'] = $row['uprawnienie'];
                    $_SESSION['uzytkownik'] = $login;?>
                    <script>

                    setTimeout(function () {
                        window.location.href= 'index.php'; // the redirect goes here

                    },1);

                    </script><?php
                }
            }
            $stmt->closeCursor();


            if (@$_SESSION['zalogowany']==false)    {

            ?>

        </div>

        <?php
        }
        ?>

    </div>
    <!-- /.row -->

</div>
<!-- /.col-lg-9 -->

</div>
<!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; J.K. & R.S. 2017</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>