<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try {
			$uprawnienie_m= $_POST['uprawnienie'];
			$uzytkownik = $_POST['uzytkownik'];
	   
			$stmt1 = $pdo -> prepare("UPDATE osoby SET osoby.UPRAWNIENIE = '".$uprawnienie_m."' where ID=".$uzytkownik." ");	
			
			$stmt1 -> execute();
			
			echo $stmt1->rowCount().' rekordów zedytowanych pomyślnie!';
			echo '<a href="uzytkownik.php">Wróć</a>';
			}
			catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }
		}
?>