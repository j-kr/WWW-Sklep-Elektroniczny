<?php
 
$db_config = array(
 
 'host' => 'localhost',
 'port' => '3306',
 'user' => 'root',
 'pass' => '',
 'db' => 'bdai', 
 'db_type' => 'mysql', 
 'encoding' => 'utf-8'
 
);
 
 
// próba połączenia
try
 
{
 
 $dane = $db_config['db_type'] .
 ':host=' . $db_config['host'] .
 ';port=' . $db_config['port'] .
 ';encoding=' . $db_config['encoding'] .
 ';dbname=' . $db_config['db'];
 
 
 // opcje, tutaj ustawienie trybu reagowania na błędy
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
 
 // tworzymy obiekt klasy PDO inicjując tym samym połączenie 
 $pdo = new PDO($dane, $db_config['user'],  $db_config['pass'], $options);
 
 // w przypadku błędu, poniższe się już nie wykona:
 define('DB_CONNECTED', true);
 
 //echo '<h1>Connection success!</h1>';	
 echo '<img src="connection.gif" alt="Połączono z bazą." width="25" align="right">';
 
  // łapiemy ewentualny wyjątek:
} catch(PDOException $e)
 
{
	echo '<img src="error.gif" alt="Błąd" width="25" align="right">'; 
 //komunikaty błędu
 //die('Unable to connect: ' . $e->getMessage());
}
 
?>