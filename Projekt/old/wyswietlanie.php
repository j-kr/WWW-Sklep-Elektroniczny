<?php
@session_start();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="UTF-8" />
	<title>Sklep internetowy</title>
	<link rel="Stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
if (@$_SESSION['zalogowany']==true){

include_once('polaczenie.php');
 try
   {

      $stmt = $pdo->query('SELECT osoby.ID AS ID_osoby, IMIE, NAZWISKO, TELEFON, EMAIL, LOGIN, HASLO, UPRAWNIENIE, NEWSLETTER, MIEJSCOWOSC, ULICA, NUMER, KOD from osoby JOIN adresy ON osoby.ID_ADRESY=adresy.ID ');
      echo '<table>';
		echo '<tr>';
			echo '<th>Imię i nazwisko</th>';
			echo '<th>Telefon</th>';
			echo '<th>E-mail</th>';
			echo '<th>Login</th>';
			echo '<th>Hasło</th>';
			echo '<th>Poziom uprawnień</th>';
			echo '<th>Adres</th>';
			echo '<th></th>';
		echo '</tr>';
	
      foreach($stmt as $row)
      {
          echo '<tr>';
			echo '<td>'.$row['IMIE'].' '.$row['NAZWISKO'].'</td>';
			echo '<td>'.$row['TELEFON'].'</td>';
			echo '<td>'.$row['EMAIL'].'</td>';
			echo '<td>'.$row['LOGIN'].'</td>';
			echo '<td>'.$row['HASLO'].'</td>';
			echo '<td>'.$row['UPRAWNIENIE'].'</td>';
			echo '<td>'.$row['MIEJSCOWOSC'].', ul.'.$row['ULICA'].' '.$row['NUMER'].' '.$row['KOD'].'</td>';
			//echo '<li>'.$row['ID_osoby'].' - '.$row['IMIE'].' - '.$row['NAZWISKO'].' - '.$row['TELEFON'].' - '.$row['EMAIL'].' - '.$row['LOGIN'].' - '.$row['HASLO'].' - '.$row['UPRAWNIENIE'].' - '.$row['NEWSLETTER'].' - '.$row['MIEJSCOWOSC'].' - '.$row['ULICA'].' - '.$row['NUMER'].' - '.$row['KOD'].'</li>';
		    echo '<td><form method="post" action="edycja.php"><input type="hidden" value="'.$row['ID_osoby'].'" name="edytuj_ktory"/><input type="submit" value="Modyfikuj"/></form>';
			echo '<form method="post" action="usun.php"><input type="hidden" value="'.$row['ID_osoby'].'" name="usun_ktory"/><input type="submit" value="Usuń"/></form>';
				echo '</td>';
	  }
      $stmt->closeCursor();
      echo '</ul>';
   }
   catch(PDOException $e)
   {
      echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
   }

?>

<form action="zaloguj.php" method="post">
  <button type="submit">Strona Główna</button>
</form>

<form action="rejestracja.php" method="post">
  <button type="submit">Dodawanie</button>
</form>
<!-- <form action="wyswietlanie.php" method="post">
  <button type="submit">Wyswietlanie</button>
</form>-->

 <?php
} 
	else{
			include_once('zaloguj.php');
	}
?>

</body>
</html>