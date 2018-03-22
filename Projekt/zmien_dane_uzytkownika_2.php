<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			try {
			$login_m= $_POST['login'];
			$haslo_m = md5($_POST['haslo']);
			$imie_m= $_POST['imie'];
			$nazwisko_m = $_POST['nazwisko'];
			$telefon_m = $_POST['telefon'];
			$email_m = $_POST['email'];
			$newsl_m = $_POST['newsletter'];
			$upraw_m = $_POST['uprawnienie'];
	
			$ktory = $_POST['edytuj_ktory'];
	   
			$stmt1 = $pdo -> prepare("UPDATE osoby SET IMIE='".$imie_m."', NAZWISKO='".$nazwisko_m."', TELEFON='".$telefon_m."', EMAIL='".$email_m."',  NEWSLETTER='".$newsl_m."', UPRAWNIENIE='".$upraw_m."',  LOGIN='".$login_m."', HASLO='".$haslo_m."' where ID=".$ktory." ");	
			
			$stmt1 -> execute();
			
			//echo $stmt1->rowCount().' rekordów zedytowanych pomyślnie!';
			echo "<script language='javascript'>alert('Zedytowano pomyślnie! ');</script>";
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
   window.location.href= 'zmien_dane_uzytkownika.php'; // the redirect goes here

},2);

</script>