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

        <div style="width: 100%"><br><br><br><br>
		
		<?php

			$stmt = $pdo->query('SELECT *, transakcje.ID AS "ID_TRANSAKCJI" FROM transakcje JOIN osoby on transakcje.ID_OSOBY=osoby.ID  WHERE osoby.ID = '.$_SESSION['id_uzytkownik'].' ');
			
			
			
			
			foreach($stmt as $row)
            {
			echo '<table border="2" style="padding: 10px">';
			echo '<tr><th>Klient</th><th>Data złożenia</th><th>Data przyjęcia</th><th>Data realizacji</th><th>Data wpłaty</th><th>Nr faktury</th><th>Forma płatności</th><th>Wartość</th><th>Faktura</th></tr>';
			
			echo '<tr><td>'.$row['IMIE'].' '.$row['NAZWISKO'].'</td><td>'.$row['DATA_ZLOZENIA'].'</td><td>'.$row['DATA_PRZYJECIA'].'</td><td>'.$row['DATA_REALIZACJI'].'</td><td>'.$row['DATA_WPLATY'].'</td><td>'.$row['NR_FAKTURY'].'</td><td>'.$row['FORMA_PLATNOSCI'].'</td><td>'.$row['WARTOSC'].'</td> ';
			
			if ($row['CZY_FAKTURA'] == 0) echo '<td>BRAK</td>';
				else echo '<td><form method="post" action="faktura.php"><input type="hidden" name="ktora_faktura" value="'.$row['ID_TRANSAKCJI'].'"><input type="submit" value="Pokaż"></form></td>';
			
			echo '<tr><td> Produkty: </td>';
			echo '<td colspan="8">';
			
			$stmt1 = $pdo->query('SELECT *, producenci.NAZWA AS "PRODUCENT", typy.NAZWA AS "TYP" FROM produkty_transakcje JOIN transakcje on transakcje.ID=produkty_transakcje.ID_TRANSAKCJE JOIN produkty on produkty.ID = produkty_transakcje.ID_PRODUKTY LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID WHERE ID_OSOBY = '.$_SESSION['id_uzytkownik'].' AND ID_TRANSAKCJE = '.$row['ID_TRANSAKCJI'].'');
			
				foreach($stmt1 as $row1){
					
					echo $row1['TYP'].' '.$row1['PRODUCENT'].' '.$row1['MODEL'].' - '.$row1['ILOSC_PRODUKTY'].' sztuk<br>';
					
				}
			echo '</td></tr>';
			echo '</tr>';
			echo '</table><br><br>';
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