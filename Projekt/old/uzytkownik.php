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

              </a>
            </li>
              <li class="nav-item">
                  <a class="nav-link" href="kontakt.php">O nas
                      <span class="sr-only">(current)</span></a>
              </li>


                  <?php
                  session_start();
                  include_once('polaczenie.php');
                  @$x = $_SESSION['uzytkownik'];

                     if (@$_SESSION['zalogowany']==true)	{

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

        <div style="width: 100%"><br><br><br>
		
		<?php
            @$id = $_SESSION['id_uzytkownik'];
			$stmt4 = $pdo->query('SELECT * from osoby JOIN adresy ON osoby.ID_adresy = adresy.ID WHERE osoby.ID="'.$id.'"');

			
        if ($_SESSION['poziom_uprawnienia'] == 'Administrator'){
            echo'<h3>Panel administratora</h3>';
            echo'<img src="/img/user_a.png" width="150" height="150"/><br><br>';
			echo '<div>';
			echo '<a href=dodawanie_produkty.php>Dodaj produkt</a><br>';
			echo '<a href=zmien_uprawnienie.php>Zmień poziom uprawnienia</a>';
			echo '</div>';
        }

        if ($_SESSION['poziom_uprawnienia'] == 'Klient'){
            echo'<h3>Panel użytkownika</h3>';
            echo'<img src="/img/user.png" width="150" height="150"/><br><br>';
            echo '<div style="float: right"><a href="koszyk.php" >';
            echo '<img src="/img/koszyk.png" style="height: 100%" alt="Koszyk">';
            echo '</a></div>';

            foreach($stmt4 as $row)
            {
                echo 'Imie i nazwisko: '.$row['IMIE'].' '.$row['NAZWISKO'].'<br>';
                echo 'Telefon: '.$row['TELEFON'].'<br>';
                echo 'E-mail: '.$row['EMAIL'].'<br>';
                echo 'Adres: '.$row['MIEJSCOWOSC'].', '.$row['ULICA'].' '.$row['NUMER'].' '.$row['KOD'].'<br>';

                if ($row['NEWSLETTER'] == 0){
                    echo 'Newsletter: nie';
                }
                else echo 'Newsletter: tak';
                echo'<br><br><br>';

            }
            echo '<a href="edytuj_dane.php"> Edytuj swoje dane </a><br>';
            echo '<a href="edytuj_adres.php"> Edytuj swój adres </a>';
        }




			
			?>
            

            <br><br>

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
