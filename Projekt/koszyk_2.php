<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="UTF-8" />
	<title>Sklep internetowy</title>
	<link rel="Stylesheet" type="text/css" href="index.css" />
</head>


<header>
	
</header>

<body>
<?php

	
//if (isset($_POST['do_koszyka'])) {
	
if ($_SESSION['koszyk'] == null){
	for ($i=0;$i<100;$i++){
		
		if(isset($_SESSION['produkt'.$i.''])){
			array_push($_SESSION['koszyk'], $_SESSION['produkt'.$i.'']);
		}
	}
}
	
	
	

if ($_SESSION['koszyk'] == null){
	
	echo "<p>Twój koszyk jest pusty. Wróć do sklepu, by coś do niego dodać</p>";
}
else{
	
	
	
echo "<div class='podsumowanie'>";
echo "<table border='1'><tr><td>Produkt</td><td>Cena</td><td>Ilość</td><td></td></tr>";
foreach($_SESSION['koszyk'] as $prod){
  echo "<tr>";
  echo "<td>"; 
  echo $prod[0]."&emsp;";
  echo $prod[1]."&emsp;";
  echo "<td>";
  echo $prod[3];
  echo "<td>".$_POST['ilosc']."";

  
  @$suma+= $prod[3];
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


//}


if (isset($_POST['accept'])) {
	echo "Przyjęto zamówienie.<br>";
	unset($_SESSION['koszyk']);
	for ($i=0;$i<100;$i++) unset($_SESSION['produkt'.$i.'']);
}




?>
<a href="index.php">Wróć</a>

</body>
</html>