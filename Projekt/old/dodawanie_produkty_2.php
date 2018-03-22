<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
	   
			$stmt1 = $pdo -> prepare('INSERT INTO `produkty` (`id_producenci_typy`, `model`, `opis`, `cena`, `ilosc`)	
			
			VALUES(
				:id_producenci_typy,
				:model,
				:opis,
				:cena,
				:ilosc)');
			
			
			$ilosc = 0;
			
			
				if(strlen($_POST['model']) > 0)
				{
					
					$stmt1 -> bindValue(':id_producenci_typy', $_POST['id_producenci_typy'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':model', $_POST['model'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':opis', $_POST['opis'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':cena', $_POST['cena'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':ilosc', $_POST['ilosc'], PDO::PARAM_STR);
					
					$ilosc += $stmt1 -> execute();	
					
					$stmt1 -> closeCursor();		// 3
				}			
		
	
			if($ilosc > 0)
			{
				echo 'Dodano: '.$ilosc.' rekordow';
			}
			else
			{
				echo 'Wystapil blad podczas dodawania rekordow!';
			}
			

		}
			?>
			
<script>

setTimeout(function () {
   window.location.href= 'dodawanie_produkty.php'; // the redirect goes here

},2000);

</script>

			