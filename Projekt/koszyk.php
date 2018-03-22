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

        if(!isset($_POST['submit_rabat'])) {
        $id_rabatu=2;}
			//if (isset($_POST['do_koszyka'])) {
	
		
		if ($_SESSION['koszyk'] == null){		
		for ($i=0;$i<100;$i++){
		
		if(isset($_SESSION['produkt'.$i.''])){
			array_push($_SESSION['koszyk'], $_SESSION['produkt'.$i.'']);
		}
	}
	
	
}
	
	@$stmtrabat = $pdo->query('SELECT * from rabaty WHERE KOD="'.$_POST['rabat'].'"');
	foreach($stmtrabat as $row)
              {
					@$rabat = $row['ZNIZKA'];
					$id_rabatu = $row['ID'];
              }
	

if ($_SESSION['koszyk'] == null){
	
	echo "<p>Twój koszyk jest pusty. Wróć do sklepu, by coś do niego dodać</p>";
}
else{
	 
	 //
	
	
echo "<div class='podsumowanie'>";
echo "<table border='1'><tr><td>Produkt</td><td>Cena</td><td>Ilość</td><td></td></tr>";
foreach($_SESSION['koszyk'] as $prod){
  echo "<tr>";
  echo "<td>"; 
  echo $prod[0]."&emsp;";
  echo $prod[1]."&emsp;<br>";
  echo $prod[2]."&emsp;";
  echo "<td>";
  echo $prod[3];
  echo "<form method='post'  action=''>";
  echo "<td>";
  echo $prod[5];
  echo "<td><input type='submit' name='usun_z_kosz".$prod[4]."' value='Usuń z koszyka' />";

  
  @$sumaa+= $prod[3]*$prod[5];
  @$suma1 = @$sumaa * ($rabat/100);
  @$suma2= $sumaa - $suma1;
  
}
echo "</form>";
  echo "</tr>";
  echo "<tr><td>Suma:</td><td>".$suma2."</td></tr>";
  echo "</table><br>";
  
echo "<form method='post'  action='koszyk.php'>";
echo "Kod rabatowy: <input type='text' name='rabat' value=''></input><br>";
echo "<input type='submit' name='submit_rabat' value='Potwierdź kod'></input>";
echo "</form>";
 
echo "<form method='post'  action='koszyk.php'>";
 echo "<input type='hidden' name='suma_calosc' value='".$suma2."'></input>";
 echo "<input type='hidden' name='id_rabaty' value='".@$id_rabatu."'></input>";
 echo "<input type='submit' name='accept' value='Potwierdź'></input>";
echo "</form>";
echo "</div>";
}


//}

  

	
for ($j=0;$j<100;$j++){
	 if (isset($_POST['usun_z_kosz'.$j.''])){	
		if(isset($_SESSION['produkt'.$j.''])){
			unset($_SESSION['produkt'.$j.'']);
		}echo "Usunięto.";
		?><script> setTimeout(function () { window.location.href= 'index.php'; },1);</script>";<?php
	}
}

if (isset($_POST['accept'])) {
	
	
	foreach($_SESSION['koszyk'] as $prod){
	$stmt3 = $pdo->prepare("UPDATE produkty SET ILOSC=ILOSC-".$prod[5]." WHERE ID=".$prod[4]."");
	
	$stmt3 -> execute();
	}
	
	$stmtrabaty = $pdo -> prepare('INSERT INTO `rabaty_transakcje` (`id_rabaty`, `id_transakcji`)
	
			VALUES(
				:id_rabaty,
				:id_transakcji)');
	
	$stmttrans = $pdo -> prepare('INSERT INTO `transakcje` (`id_osoby`, `data_zlozenia`, `data_przyjecia`, `data_realizacji`, `data_wplaty`, `nr_faktury`, `forma_platnosci`, `wartosc`, `czy_faktura`)	
			
			VALUES(
				:id_osoby,
				:data_zlozenia,
				:data_przyjecia,
				:data_realizacji,
				:data_wplaty,
				:nr_faktury,
				:forma_platnosci,
				:wartosc,
				:czy_faktura)');
				
	$stmttranspro = $pdo -> prepare('INSERT INTO `produkty_transakcje` (`id_produkty`, `id_transakcje`, `ilosc_produkty`)	
			
			VALUES(
				:id_produkty,
				:id_transakcje,
				:ilosc_produkty)');			
			
				if(strlen($_SESSION['id_uzytkownik']) > 0)
				{
					
					$stmttrans -> bindValue(':id_osoby', $_SESSION['id_uzytkownik'], PDO::PARAM_STR);
					$stmttrans -> bindValue(':data_zlozenia', date('d.j.o'), PDO::PARAM_STR);
					$stmttrans -> bindValue(':data_przyjecia', date('d.j.o'), PDO::PARAM_STR);
					$stmttrans -> bindValue(':data_realizacji', date('d.j.o'), PDO::PARAM_STR);
					$stmttrans -> bindValue(':data_wplaty', date('d.j.o'), PDO::PARAM_STR);
					$stmttrans -> bindValue(':nr_faktury', rand(1000,2000), PDO::PARAM_STR);
					$stmttrans -> bindValue(':forma_platnosci', "przelew", PDO::PARAM_STR);
					$stmttrans -> bindValue(':wartosc', $_POST['suma_calosc'], PDO::PARAM_STR);
					$stmttrans -> bindValue(':czy_faktura', "1", PDO::PARAM_STR);
					
					$stmttrans -> execute();	
					
					$stmttrans -> closeCursor();
				}
				
				$stmt0 = $pdo -> query('SELECT MAX(Id) FROM transakcje');
			
						foreach($stmt0 as $row)
						{
							$dopisz_trans = $row['MAX(Id)'];
						}
				
	foreach($_SESSION['koszyk'] as $prod){
		
		if(strlen($_SESSION['id_uzytkownik']) > 0)
				{
					
					$stmttranspro -> bindValue(':id_produkty', $prod[4], PDO::PARAM_STR);
					$stmttranspro -> bindValue(':id_transakcje', $dopisz_trans, PDO::PARAM_STR);
					$stmttranspro -> bindValue(':ilosc_produkty', $prod[5], PDO::PARAM_STR);
					
					$stmttranspro -> execute();	
					
					$stmttranspro -> closeCursor();
				}
		
	}
	

            if (@$_POST['submit_rabat'] != '') {
                $stmtrabaty->bindValue(':id_rabaty', $_POST['id_rabaty'], PDO::PARAM_STR);
                $stmtrabaty->bindValue(':id_transakcji', $dopisz_trans, PDO::PARAM_STR);

                $stmtrabaty->execute();

                $stmtrabaty->closeCursor();
            }

	
	
	unset($_SESSION['koszyk']);
	for ($i=0;$i<100;$i++) unset($_SESSION['produkt'.$i.'']);
	?><script> setTimeout(function () { window.location.href= 'index.php'; },1);</script>";<?php
}?>

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