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
              <a class="nav-link" href="index.html">Strona domowa
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
          <h1 class="my-4">Kategoria</h1>
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
              </div>

          </div>
        <br>
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


              $stmt3 = $pdo->query('SELECT produkty.ID, produkty.MODEL, produkty.OPIS, produkty.CENA, produkty.ILOSC, producenci.NAZWA AS \'PRODUCENT\', typy.NAZWA AS \'TYP\' FROM produkty LEFT JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY = producenci_typy.ID LEFT JOIN producenci ON producenci_typy.ID_PRODUCENCI = producenci.ID LEFT JOIN typy ON producenci_typy.ID_TYPY = typy.ID');
              foreach($stmt3 as $row)
              {
                  echo '<div class="col-lg-4 col-md-6 mb-4">';
                  echo '<div class="card h-100">';
                  echo '<a href="#"><img class="card-img-top" src="/img/products/'.$row['MODEL'].'.jpg" alt=""></a>';
                  echo '<div class="card-body">';
                  echo '<h4 class="card-title">';
                  echo '<a href="#">'.$row['PRODUCENT'].' '.$row['MODEL'].'</a>';
                  echo '</h4>';
                  echo '<h5></h5>';
                  echo '<p class="card-text">'.$row['OPIS'].'</p>';
                  echo '</div>';
                  echo '<div class="card-footer">';
                  echo '<small class="text-muted">Cena: '.$row['CENA'].'zł  &nbsp;  Ilość sztuk: '.$row['ILOSC'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>';



                  if(@$_SESSION['zalogowany']==true){
                      echo '<form method="post" style="display:inline;" name="do_koszyka"><input type="submit" name="transakcja'.$row['ID'].'" value="+" /></form>';
                      if (isset($_POST['transakcja'.$row['ID']])) {
                          $_SESSION['produkt'.$row['ID'].''] = array($row['PRODUCENT'], $row['MODEL'], $row['OPIS'], $row['CENA'], $row['ID']);
                          echo "<script language='javascript'>alert('Dodano do koszyka.');</script>";
                      }
                  }
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
              }



             // $_SESSION['kosz'] ['uzytkownik']= $_SESSION['uzytkownik'];
             // $_SESSION['kosz'] ['uzytkownik'] ['id']= 12;
              //echo $_SESSION['kosz'] ['produkt'];

//              for ($i=0;$i<100;$i++){
//
//              if(isset($_SESSION['produkt'.$i.''])){
//                  array_push($_SESSION['koszyk'], $_SESSION['produkt'.$i.'']);
//              }
              ?>



            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Item Two</a>
                  </h4>
                  <h5>$24.99</h5>
                  <p class="card-text">xxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

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
<BR>
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
