<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try {
			$miejscowosc_m= $_POST['miejscowosc'];
			$ulica_m = $_POST['ulica'];
			$numer_m = $_POST['numer'];
			$kod_m = $_POST['kod'];
	
			$ktory = $_POST['edytuj_ktory'];
	   
			$stmt1 = $pdo -> prepare("UPDATE adresy SET MIEJSCOWOSC='".$miejscowosc_m."', ULICA='".$ulica_m."', NUMER='".$numer_m."', KOD='".$kod_m."' where ID=".$ktory." ");	
			
			$stmt1 -> execute();
			
			echo $stmt1->rowCount().' rekordów zedytowanych pomyślnie!';
			echo '<a href="index.php">Wróć</a>';
			}
			catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }
		}
?>