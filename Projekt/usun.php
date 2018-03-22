<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try {
			
			$ktory = $_POST['usun_ktory'];
	   
			$stmt1 = $pdo -> prepare("DELETE FROM osoby where ID=".$ktory." ");	
			
			$stmt1 -> execute();
			
			echo $stmt1->rowCount().'rekordów usuniętych pomyślnie!';
			echo '<a href="zaloguj.php">Wróć</a>';
			}
			catch(PDOException $e)
    {
    echo "<br>" . $e->getMessage();
    }
		}
?>