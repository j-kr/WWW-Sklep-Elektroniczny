<?php
session_start();
$_SESSION['koszyk'] = array();
$_SESSION['produkty'] = array();
if(!isset($_SESSION['ile_kosz'])){
  $_SESSION['ile_kosz'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<title>Sklep komputerowy</title>
	<meta http-equiv="Content-Type" content="text/html, width=device-width, initial-scale=1" name="viewport"  />
	<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<br>
<div class="wrapper cz1">
	<header id="header" class="clear">
	<br><h1>Sklep komputerowy</h1><br>
	</header>

	
<?php

if (@$_SESSION['logowanie'] == 'zalogowano') {
	
echo "<br><div class='logowanie'>";
echo "<p> Zalogowany jako: ".$_SESSION['user']."</p>";
echo "<form method='post' action='wyloguj.php'><br><br>";
echo "<input class='input-btn' type='submit' name='wyloguj' value=' Wyloguj'><br>";
echo "</form>";
echo "<form method='post' action='koszyk.php'>";
echo "<input class='input-btn' type='submit' name='do_koszyka' value=' Koszyk '>";
echo "</form>";
echo "</div><br>";
}
else{

	echo '<div class="logowanie">';
	echo '<form method="post" action="zaloguj.php">';
	echo 'Login: <input type="text" name="login"><br>';
	echo 'Hasło: <input type="password" name="haslop"><br><br>';
	echo '<input type="submit" name="submitlog" value="    Zaloguj  ">';
	//echo '<br>';
	echo '</form>';
	echo '<form method="post" action="rejestracja.php">';
	echo '<input type="submit" name="submitlog" value="Rejestracja">';
	//echo '<a href="rejestracja.php">Załóż konto</a>';
	echo '</form>';
	
	echo '</div><br>';
}
?>

</div>


<div class="wrapper cz2"><br>
<?php

session_start();
include_once('polaczenie.php');
             
		if(isset($_POST["cena"])) {
		$c1 = $_POST["kategoria"];
		$c2 = $_POST["producent"];
		$c3 = $_POST["cena"];
		} 
		
		else {
		$c1 = null;
		$c2 = null;
		$c3 = null;
		}
?>
		
<form action="index.php" method="post" style="text-align: left">

<select name="kategoria" style="width: 298px">
	<option>brak</option>
	<option>Procesor</option>
	<option>Klawiatura</option>
	<option>Telefon</option>
</select>

<select name="producent" style="width: 298px">
    <option>brak</option>
	

	
<?php

		$zapytanie = "SELECT ID, Nazwa from producent";
		$wynik=mysql_query($zapytanie, $polaczenie) or die(mysql_error()); 
		$dane= mysqli_fetch_assoc($wynik);

		while ($dane = mysql_fetch_array($wynik)) {
    
			echo '<option value="' .$dane[0] .'"';
			if ($c2 == $dane[0])
			echo "selected>"; else
			echo ">";
			echo $dane[1] ."</option>";
		}
?>
	
</select>
                 
<select value="malejaco" name="cena" style="width: 298px">
    <option <?php if($c3 == "Nie sortuj") echo "selected"?>>Nie sortuj</option>
	<option <?php if($c3 == "malejaco") echo "selected"?>>malejaco</option>
	<option <?php if($c3 == "rosnaco") echo "selected"?> >rosnaco</option>
</select>


<input type="submit" value="Dalej" style="width: 50px; height:20px;"/>
</form> 



 <form action="index2.php" method="GET"><br>
  Wyszukaj: <input type=text name="imie"/>
  <input type=submit value="Wyślij"/>
  </form>
  
<?php 

@$wyszukaj = $_GET['imie'];
//echo $wyszukaj;


$zapytanie = "select produkt.ID, producent.Nazwa, produkt.Nazwa, Kategoria, Opis, Cena, Zdjecie from produkt INNER JOIN producent ON produkt.Producent_ID = producent.ID ";
    
if ($wyszukaj!="") { 
        $zapytanie = $zapytanie . " where Opis like '%".$wyszukaj."%'";
    }



	

?>








<?php
      
if($_POST)
{
$zapytanie = "select produkt.ID, producent.Nazwa, produkt.Nazwa, Kategoria, Opis, Cena, Zdjecie from produkt INNER JOIN producent ON produkt.Producent_ID = producent.ID ";

if ($c1 != "brak" || $c2 != "brak") {
        $zapytanie = $zapytanie . " where ";
    }

if ($c1 != "brak") {
        $zapytanie = $zapytanie ."Kategoria ='" . $c1 . "'";
    }

    if ($c1 != "brak" && $c2 != "brak") {
        $zapytanie = $zapytanie . " and ";
    }

    if ($c2 != "brak") {
        $zapytanie = $zapytanie ."Producent_ID =" .$c2;
    }

    if($c3 != "Nie sortuj"){
        if ($c3 == "rosnaco") {
            $zapytanie = $zapytanie ." ORDER BY Cena";
        } else {
            $zapytanie = $zapytanie ." ORDER BY Cena DESC";
        }
    }
}

else{
$zapytanie = "select produkty.ID, Nazwa, Kategoria, Opis, Cena, Zdjecie from produkty";
}


$wynik=mysql_query($zapytanie, $polaczenie) or die(mysql_error());
$ile_znalezionych=mysql_num_rows($wynik);
echo '<p>Ilosc znalezionych pozycji: '.$ile_znalezionych.'</p><hr><br>';
$div = 0;

for ($i = 0; $i < $ile_znalezionych; $i++)
{
    $dane = mysql_fetch_array($wynik);


echo '<div style="width: 25%; display:inline-block;">';
    for ($j = 0; $j < 7; $j++)
    {
        if ($j==0)
			echo '<div class="row"><div class="column"><img src="'.$dane[6].'" onclick="openModal();currentSlide(1)" class="hover-shadow cursor"></div></div><br>';
        if ($j==2)
            echo "<b>Producent: </b>".$dane[1]."<br />";
        if ($j==3)
            echo "<b>Nazwa: </b>".$dane[2]."<br />";
        if ($j==1)
            echo "<b>Kategoria: </b>".$dane[3]."<br/>";
        //if ($j==4)
           // echo "<b>Opis: </b>".$dane[4]."<br />";
        if ($j==5)
            echo "<b>Cena: </b>".$dane[5]." zł<br />";
        //if ($j==6)
            //echo "<b>ID: </b>".$dane[0]."<br />";
    }
	echo'<br>';
	
  echo '<form action="szczegoly.php" method="post" style="text-align: left">';
  echo '<input type="hidden" name="ID" value="' .$dane[0] .'">';
  echo  '<input type="submit" value="Szczegóły" style="margin : 0 auto; display: block;"/>';
  echo "</form>";
  
  
if(@$_SESSION['czy_ad']=='admin'){
  echo '<form action="edycja.php" method="post" style="text-align: left">';
  echo '<input type="hidden" name="ID" value="' .$dane[0] .'">';
  echo  '<input type="submit" value="       Edytuj          " style="margin : 0 auto; display: block;"/>';
  echo "</form>";
}
  
  
  
  
	if(@$_SESSION['logowanie']=='zalogowano'){
	echo '<form method="get" action=""><input type="submit" name="dodaj_kosz'.$dane[0].'" value="Dodaj do koszyka" /></form>';
	if (isset($_GET['dodaj_kosz'.$dane[0].''])) {
		$_SESSION['produkt'.$dane[0].''] = array($dane[1], $dane[2], $dane[3], $dane[4], $dane[5], $dane[0]);
		echo "Dodano do koszyka";
	}
	
	}
  
  
  echo '</div>';
  if ($div > 2)
  {
  echo "<hr>";

  $div = 0;
  }
  else {
   $div = $div +1;
  }
}
echo '<div id="myModal" class="modal">';
echo  '<span class="close cursor" onclick="closeModal()">&times;</span>';
echo  '<div class="modal-content">';

echo    '<div class="mySlides">';
echo      '<div class="numbertext">1 / 4</div>';
echo   '<img src="p.jpg" >';
echo    '</div>';

echo    '<div class="mySlides">';
echo      '<div class="numbertext">2 / 4</div>';
echo        '<img src="k.jpg" >';
echo    '</div>';

echo    '<div class="mySlides">';
echo      '<div class="numbertext">3 / 4</div>';
echo        '<img src="t.jpg">';
echo    '</div>';

echo    '<a class="prev" onclick="plusSlides(-1)">&#10094;</a>';
echo    '<a class="next" onclick="plusSlides(1)">&#10095;</a>';

echo    '<div class="caption-container">';
echo      '<p id="caption"></p>';
echo    '</div>';

echo    '<div class="column">';
echo      '<img class="demo" src="p.jpg" onclick="currentSlide(1)" alt="">';
echo  '</div>';

echo    '<div class="column">';
echo      '<img class="demo" src="k.jpg" onclick="currentSlide(2)" alt="">';
echo    '</div>';

echo    '<div class="column">';
echo      '<img class="demo" src="t.jpg" onclick="currentSlide(3)" alt="">';
echo    '</div>';

echo  '</div>';
echo '</div>';

echo "<hr>";
if(@$_SESSION['czy_ad']=='admin'){
?>

<br><br>
	<a href="dodaj.php"><button style="width: 150px; height:20px;">Dodaj produkt </button> </a>
    <a href="dodajproducenta.php"><button style="width: 150px; height:20px;">Dodaj producenta </button> </a>
	<a href="edycjaproducenta.php"><button style="width: 150px; height:20px;">Edytuj producenta </button> </a>
	<a href="dodaj_zdjecie.php"><button style="width: 150px; height:20px;">Dodaj Zdjecie </button> </a>


<?php
}
?>	
<br>
<br>
</div>

<div class="wrapper cz1">
  <footer id="stopka" class="clear">
    <br><p>Autor: Jakub Kruczkowski</p><br>
  </footer>
</div>
<br>
<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</body>
</html>