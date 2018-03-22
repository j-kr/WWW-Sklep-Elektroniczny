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

        <div style="width: 100%; text-align: center"><br><br><br><br>
		
		<?php

        $stmtkategoria = $pdo -> query ('SET NAMES utf8');
        $stmtkategoria = $pdo->query("SELECT producenci_typy.ID, CONCAT(producenci.nazwa,' ',typy.nazwa) as pelna_nazwa from producenci_typy JOIN producenci on producenci_typy.ID_producenci = producenci.ID JOIN typy ON producenci_typy.ID_typy = typy.ID ORDER BY pelna_nazwa ASC");
			
		
		?>

            <form method="post" action="dodawanie_produkty_2.php">
		
					<?php
					
						echo '<p>Kategoria: <select name="id_producenci_typy">';
						foreach($stmtkategoria as $row){
							echo '<option value="'.$row['ID'].'">'.$row['pelna_nazwa'].'</option>';
						}
						echo '</select></p>';
						
					?>
					
					<p>Model: <input type="text" name="model"/></p>
					<p>Opis: <input type="text" name="opis"/></p>
					<p>Cena(zł): <input type="number" name="cena"/></p>
					<p>Ilość: <input type="number" name="ilosc"/></p>
					
		
			<p><input type="submit" value="Dodaj"/></p></form>

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