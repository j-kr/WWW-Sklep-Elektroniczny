<?php
session_start();
//polaczenie z baza
include_once('polaczenie.php');

?>
<br><br><br><br><br><br><br><br><br><br>

<link rel="stylesheet" href="style.css">
<div>
	<div id="container_content">
	
<?php

			
	  @$login = $_POST['login'];
	  @$password = $_POST['password'];	
	  $stmt = $pdo->query('SELECT login, haslo FROM osoby');
      foreach($stmt as $row)
      {
          if($login == $row['login'] and $password == $row['haslo']){
			  $_SESSION['zalogowany'] = true;
		  }
      }
      $stmt->closeCursor();
			

	if (@$_SESSION['zalogowany']==false)	{	
		
?>
		

			<form action="index.php" method="POST">
					<div>
						<label for="login">Login: </label>
						<input type="text" name="login"/>
					</div>
					<div>
						<label for="password">Hasło: </label>
						<input type="password" name="password"/>
					</div>
					<button type="submit" >Zaloguj</button>				
			</form>
		
		</div>
</div>



<?php 

	} 
	else{

?>	





<!--<form action="index.php" method="post">
  <button type="submit">Strona Główna</button>
</form>-->

<form action="dodawanie.php" method="post">
  <button type="submit">Dodawanie</button>
</form>
<form action="wyswietlanie.php" method="post">
  <button type="submit">Wyswietlanie</button>
</form>
<form action="wyloguj.php" method="post">
  <button type="submit">Wyloguj</button>
</form>
<?php 
	} 
?>	





