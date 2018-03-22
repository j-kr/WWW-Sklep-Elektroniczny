<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<title>Sklep komputerowy</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
<br>
<div class="wrapper cz1">
	<header id="header" class="clear">
	<br><h1>Koszyk</h1><br>
	</header>
</div>
                        
<div class="wrapper cz2"><br>     
<?php

	
if (isset($_POST['do_koszyka'])) {
	
if ($_SESSION['koszyk'] == null){
	for ($i=0;$i<100;$i++){
		
		if(isset($_SESSION['produkt'.$i.''])){
			array_push($_SESSION['koszyk'], $_SESSION['produkt'.$i.'']);
		}
	}
}
	
	
	

if ($_SESSION['koszyk'] == null){
	
	echo "<p>Twój koszyk jest pusty. Wróć do sklepu, by coś do niego dodać.</p>";
}
else{
	
	
	
echo '<div style="display:block; margin:0 auto; width:500px; text-align:center;">';
echo "<table border='1'><tr><td>Produkt</td><td>Cena</td><td></td></tr>";
foreach($_SESSION['koszyk'] as $prod){
  echo "<tr>";
  echo "<td>"; 
  echo $prod[0]."&emsp;";
  echo $prod[1]."&emsp;";
  echo $prod[2]."&emsp;";
   echo $prod[3]."&emsp;";

  echo "<td>";
  echo $prod[4];
  echo "<form method='post'  action=''>";
  echo "<td><input type='submit' name='usun_z_kosz".$prod[5]."' value='Usuń z koszyka' />";

  
  @$suma+= $prod[4];
}
echo "</form>";
  echo "</tr>";
  echo "<tr><td>Suma:</td><td>".$suma."</td></tr>";
  echo "</table><br>";
echo "<form method='post'  action=''>";
echo "<input type='submit' name='accept' value='Potwierdź'></input>";
echo "</form>";
echo "</div>";
}


}

  

	
for ($j=0;$j<100;$j++){
	 if (isset($_POST['usun_z_kosz'.$j.''])){	
		if(isset($_SESSION['produkt'.$j.''])){
			unset($_SESSION['produkt'.$j.'']);
		}echo "Usunięto.";
	}
}

if (isset($_POST['accept'])) {
	echo "Przyjęto zamówienie.<br>";
	unset($_SESSION['koszyk']);
	for ($i=0;$i<100;$i++) unset($_SESSION['produkt'.$i.'']);
}




?>
<br>
<a href="index.php">Wróć</a>
</div>
<div class="wrapper cz1">
  <footer id="stopka" class="clear">
    <br><p>Autor: Jakub Kruczkowski</p><br>
  </footer>
</div>
<br>

</body>
</html>