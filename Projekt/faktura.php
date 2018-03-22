<?php

//polaczenie z baza
include_once('polaczenie.php');

$stmt = $pdo->query('SELECT * FROM produkty_transakcje 
					JOIN transakcje ON produkty_transakcje.ID_TRANSAKCJE=transakcje.ID 
					JOIN osoby ON transakcje.ID_OSOBY=osoby.ID 
					JOIN adresy ON osoby.ID_ADRESY=adresy.ID 
					WHERE ID_TRANSAKCJE='.$_POST['ktora_faktura'].'
					LIMIT 1');

$lp = 0;
$suma_netto = 0;
$suma_vat = 0;
$suma_brutto = 0;

foreach ($stmt as $row){
		
	$stmt1 = $pdo->query('SELECT *, typy.NAZWA AS "TYP", producenci.NAZWA AS "PRODUCENT" FROM produkty_transakcje 
					JOIN produkty ON produkty_transakcje.ID_PRODUKTY=produkty.ID 
					JOIN transakcje ON produkty_transakcje.ID_TRANSAKCJE=transakcje.ID 
					JOIN producenci_typy ON produkty.ID_PRODUCENCI_TYPY=producenci_typy.ID
					JOIN producenci ON producenci_typy.ID_PRODUCENCI=producenci.ID
					JOIN typy ON producenci_typy.ID_TYPY=typy.ID
					WHERE ID_TRANSAKCJE='.$_POST['ktora_faktura'].'');
?>
<head>
<link href="css/faktura.css" rel="stylesheet">
</head>

<body>

	<div id="faktura">
	<h2>Faktrua VAT</h2>
	<h4>ORYGINAŁ</h4>
	
	<p id="daty">
	Nysa, dnia: <?php echo '&nbsp&nbsp&nbsp'.$row['DATA_ZLOZENIA']; ?><br>
	Data sprzedaży: <?php echo '&nbsp&nbsp&nbsp'.$row['DATA_REALIZACJI']; ?><br>
	Termin zapłaty: <?php echo '&nbsp&nbsp&nbsp'.$row['DATA_WPLATY']; ?><br>
	</p>
	
	<div id="sprzedawca">
		SPRZEDAWCA<hr><br>
		Jakub Kruczkowski & Rafał Siwoń<br>
		ul. Mytusom 61/9<br>
		Nysa 48-300<br>
	</div>
	
	<div id="nabywca">
		NABYWCA<hr><br>
		<?php echo $row['IMIE'].' '.$row['NAZWISKO']; ?><br>
		ul. <?php echo $row['ULICA'].' '.$row['NUMER']; ?><br>
		<?php echo $row['MIEJSCOWOSC'].' '.$row['KOD']; ?><br>
	</div>

	<br><br><br>
	
	<table>
	<tr><th>LP.</th><th>Nazwa</th><th>Ilość</th><th>Jm</th><th>Wartość netto</th><th>Stawka VAT</th><th>Kwota VAT</th><th>Wartość brutto</th></tr>
	<tr>
	<?php foreach($stmt1 as $row1){ $lp++;?>
	<td><?php echo $lp; ?></td>
	<td><?php echo $row1['PRODUCENT'].' '.$row1['MODEL'].' - '.$row1['TYP']; ?></td>
	<td><?php echo $row1['ILOSC_PRODUKTY']; ?></td>
	<td>szt.</td>
	<td><?php echo ($row1['ILOSC_PRODUKTY'] * ($row1['CENA']-($row1['CENA'] * 0.23))); $suma_netto = $suma_netto + ($row1['ILOSC_PRODUKTY'] *($row1['CENA']-($row1['CENA'] * 0.23))); ?></td>
	<td>23 %</td>
	<td><?php echo ($row1['ILOSC_PRODUKTY'] *($row1['CENA'] * 0.23)); $suma_vat = $suma_vat + ($row1['ILOSC_PRODUKTY'] *($row1['CENA'] * 0.23)); ?></td>
	<td><?php echo ($row1['ILOSC_PRODUKTY'] *$row1['CENA']); $suma_brutto = $suma_brutto + ($row1['ILOSC_PRODUKTY'] * $row1['CENA']); ?></td>
	</tr>
	<?php } ?>
	<tr>
	<td colspan="4" style="text-align: right">RAZEM: </td>
	<td> <?php echo $suma_netto; ?></td>
	<td>X</td>
	<td> <?php echo $suma_vat; ?></td>
	<td> <?php echo $row1['WARTOSC']; ?></td>
	</tr>
	</table>

	<p id="razem">
	Razem do zapłaty: <?php echo $row1['WARTOSC'].' PLN'; ?>
	
	<br><br><br><br>
	<div id="podpis_lewy">
	.....................................................<br>
	Osoba upoważniona do odbioru 
	</div>
	
	<div id="podpis_prawy">
	.....................................................<br>
	Osoba upoważniona do wystawienia
	</div> 

<?php
}
?>
</body>	