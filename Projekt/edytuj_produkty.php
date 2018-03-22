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

                         $stmt = $pdo -> query ('SET NAMES utf8');
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

          $stmt1 = $pdo -> query ('SET NAMES utf8');
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

          $stmt2 = $pdo -> query ('SET NAMES utf8');
          $stmt2 = $pdo->query('SELECT nazwa from producenci');

                  foreach($stmt2 as $row)
                  {
                      echo '<a href="#" class="list-group-item">'.$row['nazwa'].'</a>';
                  }
                  ?>
              </div>-->

          </div>

        <!-- /.col-lg-3 -->

        <div style="width: 100%"><br><br><br><br>
		
		<?php

        $stmtprodukt = $pdo -> query ('SET NAMES utf8');
        $stmtprodukt = $pdo->query("SELECT produkty.ID, produkty.MODEL, producenci.NAZWA AS 'PRODUCENT', typy.NAZWA AS 'TYP' FROM produkty LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID ");
			
		
		?>

            <form method="post">
		
					<?php
					
						echo '<p>Produkt: <select name="id_produkty">';
						echo '<option value="" disabled selected>Wybierz</option>';
						foreach($stmtprodukt as $row){
							echo '<option value="'.$row['ID'].'">'.$row['PRODUCENT'].' '.$row['MODEL'].' - '.$row['TYP'].'</option>';
						}
						echo '</select></p>';
						
					?>
					
			<p><input type="submit" name="pokaz" value="Pokaz"/></p></form>
			<hr>
		<?php
		
			if (isset($_POST['pokaz'])) {

                $stmtpro = $pdo -> query ('SET NAMES utf8');
			    $stmtpro = $pdo->query('SELECT * from produkty WHERE produkty.ID='.$_POST['id_produkty'].'');

                $stmtobraz = $pdo -> query ('SET NAMES utf8');
			    $stmtobraz = $pdo->query('SELECT * from obrazy');
				
				
				
				foreach($stmtpro as $row){
				
				@$id_produkt = $row['ID'];
				echo '<form method="post" action="edytuj_produkty_2.php">';
				echo 'Model: <input type="text" name="model" value="'.$row['MODEL'].'" /><br><br>';
				echo 'Opis: <input type="text" name="opis" value="'.$row['OPIS'].'" /><br><br>';
				echo 'Cena: <input type="number" name="cena" value="'.$row['CENA'].'" /><br><br>';
				echo 'Ilość: <input type="number" name="ilosc" value="'.$row['ILOSC'].'" /><br><br>';
				}
				
				echo '<p>Obraz: <select name="id_obrazy">';
						foreach($stmtobraz as $row){
							echo '<option value="'.$row['ID'].'">'.$row['NAZWA'].'</option>';
						}
						echo '</select></p>';
				
				echo '<input type="submit" value="Zatwierdź"/>';
				echo '<input type="hidden" name="edytuj_ktory" value="'.$id_produkt.'" />';
			}
		?>

            <br><br><br><br>

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