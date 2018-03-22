<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try {
			
			$ktory = $_POST['usun_ktory'];
	   
			$stmt1 = $pdo -> prepare("DELETE FROM produkty  where ID=".$ktory." ");	
			
			$stmt1 -> execute();
			
			//echo $stmt1->rowCount().' rekordów usuniętych pomyślnie!';
			echo "<script language='javascript'>alert('Usunięto pomyślnie! ');</script>";
			//echo '<a href="index.php">Wróć</a>';
			}
			catch(PDOException $e)
				{
				echo "<br>" . $e->getMessage();
			}
	
	
	
		}
?>

<script>

setTimeout(function () {
   window.location.href= 'usuwanie_produkty.php'; // the redirect goes here

},200);

</script>