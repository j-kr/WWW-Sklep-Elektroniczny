<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try {
			$imie_m= $_POST['imie'];
			$nazwisko_m = $_POST['nazwisko'];
			$telefon_m = $_POST['telefon'];
			$email_m = $_POST['email'];
			//$city_m = $_POST['miejscowosc'];
			//$ulica_m = $_POST['ulica'];
			//$numer_m = $_POST['numer'];
			//$kod_m = $_POST['kod'];
			$newsl_m = $_POST['newsletter'];
			$login_m = $_POST['login'];
			$haslo_m = $_POST['haslo'];
			$uprawnienie_m = $_POST['uprawnienie'];
	
			$ktory = $_POST['edytuj_ktory_dalej'];
	   
			$stmt1 = $pdo -> prepare("UPDATE osoby SET IMIE='".$imie_m."', NAZWISKO='".$nazwisko_m."', TELEFON='".$telefon_m."', EMAIL='".$email_m."',  LOGIN='".$login_m."', HASLO='".$haslo_m."', UPRAWNIENIE='".$uprawnienie_m."', NEWSLETTER='".$newsl_m."' where ID=".$ktory." ");	
			
			$stmt1 -> execute();
			
			echo $stmt1->rowCount().' rekordów zedytowanych pomyślnie!';
			echo '<a href="zaloguj.php">Wróć</a>';
			}
			catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }
		}
?>