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
				  $_SESSION['sz'] = array();
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
                                </li>';
								echo ' <li class="nav-item"><a class="nav-link" href="koszyk.php">Koszyk</a>';
								}
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
			<div class="list-group"><br>
			
			<form action="index.php" method="GET"><br>
			<input style="width:150px" type="text" name="szukaj"/>
			<input type="submit" value="Wyszukaj"/>
			<br><br>
			</form>
			
			<form method="post" action="index.php">
			<select name="sortowanie" style="width:150px">
				<option value="bez" selected>Bez sortowania</option>
				<option value="asc">Rosnąco</option>
				<option value="desc">Malejąco</option>
			</select>
			<input type="submit" style="width:80px" name="submit_sortuj" value="Sortuj">
			</form>
			
			

			</div>
			
          <h1 class="my-4">Kategoria</h1>
          <div class="list-group">
              <?php

              $stmt1 = $pdo -> query ('SET NAMES utf8');
              $stmt1 = $pdo->query('SELECT nazwa from typy');

              foreach($stmt1 as $_SESSION['szczegol'])
              {
                   echo '<form  method="get" class="list-group-item"><input type="hidden" name="c1" value="'.$_SESSION['szczegol']['nazwa'].'"> <input style="width: 220px; height: 20px; background-color: white; color: black; border: 0px solid #e7e7e7;" type="submit" value="'.$_SESSION['szczegol']['nazwa'].'" ></form>';
              }
              ?>
          </div>

            <div id="demo" class="list-group">
              <h1 class="my-4">Producent</h1>
                  <?php

                  $stmt2 = $pdo -> query ('SET NAMES utf8');
                  $stmt2 = $pdo->query('SELECT nazwa from producenci');

                  foreach($stmt2 as $_SESSION['szczegol'])
                  {
                      echo '<form  method="get" class="list-group-item"><input type="hidden" name="c2" value="'.$_SESSION['szczegol']['nazwa'].'"> <input style="width: 220px; height: 20px; background-color: white; color: black; border: 0px solid #e7e7e7;" type="submit" value="'.$_SESSION['szczegol']['nazwa'].'" ></form>';
                  }
                  ?>
              </div>
            <br>
          </div>
        <br><br>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="/img/slajd1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="/img/slajd2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="/img/slajd3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">

              <?php
			  
			  @$c1 = $_GET['c1'];
			  @$c2 = $_GET['c2'];
			  
			$zapytanie = ('SELECT produkty.ID, produkty.MODEL, produkty.OPIS, produkty.CENA, produkty.ILOSC, producenci.NAZWA AS \'PRODUCENT\', typy.NAZWA AS \'TYP\' FROM produkty LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID');
    
			if ($c1 != "" || $c2 != "") { 
				$zapytanie = $zapytanie . " where ";
			}

			if ($c1 != "") {
				$zapytanie = $zapytanie ."typy.NAZWA ='". $c1."'";
			}

			if ($c1 != "" && $c2 != "") {
				$zapytanie = $zapytanie . " and ";
			}

			if ($c2 != "") {
				$zapytanie = $zapytanie ."producenci.NAZWA ='". $c2."'";
			}        

			
			 @$wyszukaj = $_GET['szukaj'];

			
			if ($wyszukaj!="") { 
			$zapytanie = $zapytanie . " where OPIS like '%".$wyszukaj."%'";
			}
				$stmt3 = $pdo->query($zapytanie);
			 //$stmt3 = $pdo -> query ('SET NAMES utf8');
			  //$stmt3 = $pdo->query('SELECT produkty.ID, produkty.MODEL, produkty.OPIS, produkty.CENA, produkty.ILOSC, producenci.NAZWA AS \'PRODUCENT\', typy.NAZWA AS \'TYP\' FROM produkty LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID');

			  
              if(isset ($_POST['submit_sortuj'])){
				  $sort = $_POST['sortowanie'];
			  
			  if ($sort == "bez"){
			  $stmt3 = $pdo -> query ('SET NAMES utf8');
              $stmt3 = $pdo->query('SELECT produkty.ID, produkty.MODEL, produkty.OPIS, produkty.CENA, produkty.ILOSC, producenci.NAZWA AS \'PRODUCENT\', typy.NAZWA AS \'TYP\' FROM produkty LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID');
			  }
			  
			  if ($sort == "asc"){
			  $stmt3 = $pdo -> query ('SET NAMES utf8');
              $stmt3 = $pdo->query('SELECT produkty.ID, produkty.MODEL, produkty.OPIS, produkty.CENA, produkty.ILOSC, producenci.NAZWA AS \'PRODUCENT\', typy.NAZWA AS \'TYP\' FROM produkty LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID ORDER BY CENA ASC');
			  }
			  
			  if ($sort == "desc"){
			  $stmt3 = $pdo -> query ('SET NAMES utf8');
              $stmt3 = $pdo->query('SELECT produkty.ID, produkty.MODEL, produkty.OPIS, produkty.CENA, produkty.ILOSC, producenci.NAZWA AS \'PRODUCENT\', typy.NAZWA AS \'TYP\' FROM produkty LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID ORDER BY CENA DESC');
			  }
			  
			  }
			//if ($_SESSION['szukaj_producent'] != null){
			
				//if ($_SESSION['szukaj_producent'] == $_SESSION['szczegol']['PRODUCENT'];
			
			//}
			for ($i=0;$i<100;$i++){
              if(isset($_SESSION['szczegol'.$i])){
                  array_push($_SESSION['sz'], $_SESSION['szczegol'.$i]);
              }
			}

              foreach($_SESSION['sz'] as $s) {

                  echo '<div class="" style="text-align: center">';
                  echo '<div class="card h-100">';
                  echo '<a href="#"><img class="card-img-top" src="/img/products/' . $s[1] . '.jpg" alt=""></a>';
                  echo '<div class="card-body">';
                  echo '<h4 class="card-title">';
                  echo '<a href="#">' . $s[0] . ' ' . $s[1] . '</a>';
                  echo '</h4>';
                  echo '<h5></h5>';
                  echo '<p class="card-text">' . $s[2] . '<br> Produkt ten wyposażony jest również w bardzo wiele ciekawych, oraz nadwyraz interesującch funkcji, których wymienienie zajęłoby tyle czasu że nie udały by się niestety Panu sprawdzić do końca naszej pracy, dlatego postanowiliśmy oszczędzić Panu tych detali.</p>';
                  echo '</div>';
                  echo '<div class="card-footer">';
                  echo '<small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>';

                  if (@$_SESSION['zalogowany'] == true) {
                      echo '<form method="post" style="display:inline;">';
                      echo '<input type="number"  style="width: 62%;" min="1" max="'.$row['ILOSC'].'"name="ilosc" value="1"/>';
                      echo '<input type="submit"  style="width: 38%;" name="transakcja'.$row['ID'].'" value="Kup" /></form>';

                      if (isset($_POST['transakcja' . $s['ID']])) {
                          $_SESSION['produkt' . $s['ID'] . ''] = array($s['PRODUCENT'], $s['MODEL'], $s['OPIS'], $s['CENA'], $s['ID'], $_POST['ilosc']);
                          echo "<script language='javascript'>alert('Dodano do koszyka.');</script>";
                      }
                  }
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
              }
              ?>



<!--            <div class="col-lg-4 col-md-6 mb-4">-->
<!--              <div class="card h-100">-->
<!--                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>-->
<!--                <div class="card-body">-->
<!--                  <h4 class="card-title">-->
<!--                    <a href="#">Item Two</a>-->
<!--                  </h4>-->
<!--                  <h5>$24.99</h5>-->
<!--                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>-->
<!--                </div>-->
<!--                <div class="card-footer">-->
<!--                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="col-lg-4 col-md-6 mb-4">-->
<!--              <div class="card h-100">-->
<!--                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>-->
<!--                <div class="card-body">-->
<!--                  <h4 class="card-title">-->
<!--                    <a href="#">Item Three</a>-->
<!--                  </h4>-->
<!--                  <h5>$24.99</h5>-->
<!--                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>-->
<!--                </div>-->
<!--                <div class="card-footer">-->
<!--                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->


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
