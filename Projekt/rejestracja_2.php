<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
	   
			$stmtsprawdz = $pdo->query('SELECT * from osoby');
			
			foreach($stmtsprawdz as $row){
				if ($row['LOGIN'] == $_POST['login']){
					echo 'Użytkownik o takim loginie już istnieje !';
					?>
					<script>

					setTimeout(function () {
					window.location.href= 'index.php'; // the redirect goes here
					},3000);
					</script>
					<?php
					exit;
				}
			}
			
			$stmt1 = $pdo -> prepare('INSERT INTO `osoby` (`imie`, `nazwisko`, `telefon`, `email`, `login`, `haslo`, `uprawnienie`, `newsletter`, `id_adresy`)	
			
			VALUES(
				:imie,
				:nazwisko,
				:telefon,
				:email,
				:login,
				:haslo,
				:uprawnienie,
				:newsletter,
				:id_adresy)'); // 1
				
			$stmt2 = $pdo -> prepare('INSERT INTO `adresy` (`miejscowosc`, `ulica`, `numer`, `kod`)	
			
			VALUES(
				:miejscowosc,
				:ulica,
				:numer,
				:kod)'); // 1
			
			$ilosc = 0;
			
			
			
			
			
				if(strlen($_POST['imie']) > 0)
				{
					
					$stmt2 -> bindValue(':miejscowosc', $_POST['miejscowosc'], PDO::PARAM_STR);
					$stmt2 -> bindValue(':ulica', $_POST['ulica'], PDO::PARAM_STR);
					$stmt2 -> bindValue(':numer', $_POST['numer'], PDO::PARAM_STR);
					$stmt2 -> bindValue(':kod', $_POST['kod'], PDO::PARAM_STR);
					
					$stmt2 -> execute();
					$stmt2 -> closeCursor();					
					
					$stmt3 = $pdo -> query('SELECT MAX(Id) FROM adresy');
			
						foreach($stmt3 as $row)
						{
							$dopisz_adres = $row['MAX(Id)'];
						}
					
					$stmt1 -> bindValue(':imie', $_POST['imie'], PDO::PARAM_STR); // 2
					$stmt1 -> bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':telefon', $_POST['telefon'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':email', $_POST['email'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':login', $_POST['login'], PDO::PARAM_STR);
					$stmt1 -> bindValue(':haslo', md5($_POST['haslo']), PDO::PARAM_STR);
					@$stmt1 -> bindValue(':uprawnienie', Klient, PDO::PARAM_STR);
					$stmt1 -> bindValue(':newsletter', $_POST['newsletter'], PDO::PARAM_STR);
				    $stmt1 -> bindValue(':id_adresy', $dopisz_adres, PDO::PARAM_INT);

					
					
					$ilosc += $stmt1 -> execute();	
					$stmt1 -> closeCursor();		// 3
				}			
		
	
			if($ilosc > 0)
			{
				echo "<script language='javascript'>alert('Pomyślnie zarejestrowano! ');</script>";

			}
			else
			{
				echo "<script language='javascript'>alert('Błąd rejestracji! ');</script>";
			}
			

		}
			?>
			
<script>

setTimeout(function () {
   window.location.href= 'index.php'; // the redirect goes here

},1);

</script>

			