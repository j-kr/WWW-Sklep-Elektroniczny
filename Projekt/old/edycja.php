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

$ktory = $_POST['edytuj_ktory'];

include_once('polaczenie.php');
 try
   {

      $stmt = $pdo->query('SELECT * from osoby WHERE osoby.ID='.$ktory.'');
	  foreach($stmt as $row)
      {
		  echo '<form method="post" action="edycja_2.php">';
		  echo 'Imie: <input type="text" name="imie" value="'.$row['IMIE'].'" /><br><br>';
		  echo 'Nazwisko: <input type="text" name="nazwisko" value="'.$row['NAZWISKO'].'" /><br><br>';
		  echo 'Telefon: <input type="text" name="telefon" value="'.$row['TELEFON'].'" /><br><br>';
		  echo 'E-mail: <input type="text" name="email" value="'.$row['EMAIL'].'" /><br><br><br><br>';
		  //echo 'Miejscowość: <input type="text" name="miejscowosc" value="'.$row['MIEJSCOWOSC'].'" /><br><br>';
		  //echo 'Ulica: <input type="text" name="ulica" value="'.$row['ULICA'].'" /><br><br>';
		  //echo 'Numer: <input type="text" name="numer" value="'.$row['NUMER'].'" /><br><br>';
		  //echo 'Kod pocztowy: <input type="text" name="kod" value="'.$row['KOD'].'" /><br><br>';
		  
		  echo '<p>Id_Adresy: <select name="id_adresy">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					</select></p>';
					
		  echo 'Newsletter: <select name="newsletter">';
			echo '<option value="0" selected>Nie</option>';
			echo '<option value="1">Tak</option>';
		  echo '</select>';
		  echo '<br><br><br><br>';
		  
		  echo 'Login: <input type="text" name="login" value="'.$row['LOGIN'].'" /><br><br>';
		  echo 'Hasło: <input type="text" name="haslo" value="'.$row['HASLO'].'" /><br><br>';
		  echo 'Uprawnienie: <select name="uprawnienie">';
			echo '<option value="Administrator">Administrator</option>';
			echo '<option value="Klient">Klient</option>';
		  echo '</select>';
		  echo '<br><br>';
		  
		  echo '<input type="submit" value="Zatwierdź"/>';
		  echo '<input type="hidden" name="edytuj_ktory_dalej" value="'.$row['ID'].'" />';
	  }
	  $stmt->closeCursor();
   }
	catch(PDOException $e)
		{
			echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
		}
 ?>
 
 <?php
} 
	else{
			include_once('zaloguj.php');
	}
?>