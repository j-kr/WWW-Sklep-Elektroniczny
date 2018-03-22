<?php

//polaczenie z baza
include_once('polaczenie.php');
	
	
			echo '<form method="post" action="rejestrcja_2.php">';
		
		
				echo '<hr/>
					<p>Imie: <input type="text" name="imie"/></p>
					<p>Nazwisko: <input type="text" name="nazwisko"/></p>
					<p>Telefon: <input type="text" name="telefon"/></p>
					<p>Email: <input type="text" name="email"/></p>
					<p>Login: <input type="text" name="login"/></p>
					<p>Haslo: <input type="text" name="haslo"/></p>
					<p>Uprawnienie: <select name="uprawnienie">
					<option value="Administrator">Administrator</option>
					<option value="Pracownik">Pracownik</option>
					<option value="Klient">Klient</option></select></p>
					<p>Newsletter: <select name="newsletter">
					<option value="1">Tak</option>
					<option value="0">Nie</option></select></p>
					<p>Miejscowosc: <input type="text" name="miejscowosc"/></p>
					<p>Ulica: <input type="text" name="ulica"/></p>
					<p>Numer: <input type="text" name="numer"/></p>
					<p>Kod: <input type="text" name="kod"/></p>
					<p>Id_Adresy: <select name="id_adresy">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					</select></p>';
		
			echo '<p><input type="submit" value="Dodaj"/></p></form>';

?>


































<form action="index.php" method="post">
  <button type="submit">Strona Główna</button>
</form>

<!--<form action="dodawanie.php" method="post">
  <button type="submit">Dodawanie</button>
</form>-->




