<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try {
			$model_m= $_POST['model'];
			$opis_m = $_POST['opis'];
			$cena_m = $_POST['cena'];
			$ilosc_m = $_POST['ilosc'];
	
			$ktory = $_POST['edytuj_ktory'];
	   
			$stmt1 = $pdo -> prepare("UPDATE produkty SET MODEL='".$model_m."', OPIS='".$opis_m."', CENA='".$cena_m."', ILOSC='".$ilosc_m."' where ID=".$ktory." ");	
			
			$stmt1 -> execute();
			
			//echo $stmt1->rowCount().' rekordów zedytowanych pomyślnie!';
			echo "<script language='javascript'>alert('Zedytowano pomyślnie! ');</script>";
			//echo '<a href="index.php">Wróć</a>';
			}
			catch(PDOException $e)
				{
				echo "<br>" . $e->getMessage();
			}
	
	
		try {
			
			$stmt2 = $pdo -> prepare('INSERT INTO `produkty_obrazy` (`id_obrazy`, `id_produkty`)	
			
			VALUES(
				:id_obrazy,
				:id_produkty)');
			
				if(strlen(@$_POST['id_obrazy']) > 0)
				{
					
					@$stmt2 -> bindValue(':id_obrazy', $_POST['id_obrazy'], PDO::PARAM_STR);
					@$stmt2 -> bindValue(':id_produkty', $ktory, PDO::PARAM_STR);
					
					$stmt2 -> execute();	
					
					$stmt2 -> closeCursor();		// 3
				}			
			
			}
			catch(PDOException $e)
				{
				echo "<br>" . $e->getMessage();
			}
	
	
		}
?>
        <script>

        setTimeout(function () {
           window.location.href= 'edytuj_produkty.php'; // the redirect goes here

        },200);

        </script>