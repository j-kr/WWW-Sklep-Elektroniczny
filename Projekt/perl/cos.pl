#!/usr/bin/perl -w 
use DBI; 
use strict; 
use feature qw(say);
use warnings;
use v5.10;
use DBD::mysql;

my $dbh = DBI->connect('DBI:mysql:perl', 'root', ''); 
           die "Can't connect: " . DBI->errstr() unless $dbh; 
print "Success: connected!\n"; 

say "=====================";
say "======= MENU ========";
say "=====================";
say "= 1)Wyswietl Tabele=";
say "= 2)Dodaj do Tabeli=";
say "= 3)Edytuj Tabele   =";
say "= 4)Dodaj Tabele    =";
say "= 5)Usun Tabele    =";
say "=====================";
say "= 0)Wyjscie         =";
say "=====================";
my $wybor = <STDIN>;
chomp $wybor;


if($wybor==1)
{
	my $query = "SELECT * FROM dane";
my $query_handle =$dbh->prepare($query);

# EXECUTE THE QUERY
$query_handle->execute();

# BIND TABLE COLUMNS TO VARIABLES
$query_handle->bind_columns(undef, \my $id, \my $dana1, \my $dana2, \my $liczba);

# LOOP THROUGH RESULTS
while($query_handle->fetch()) {

   say "ID: $id";
   say "dana1: $dana1";
   say "dana2: $dana2";
   say "liczba: $liczba";
}

print("Ktory element usunac?(0=nic)");

my $wybierz = <STDIN>;
chomp $wybierz;

$dbh->do('DELETE FROM dane WHERE id = ? ',
	  undef,
	  $wybierz);

}


if($wybor==2)
{
	say "Dane1:"; 
		my $wa = <STDIN>; 
		chomp $wa;
		

	say "Dane2:"; 
		my $wa1 = <STDIN>; 
		chomp $wa1;

	say "Liczba:"; 
		my $wa2 = <STDIN>; 		 
		chomp $wa2;


	$dbh->do('INSERT INTO dane (dana1, dana2, liczba) VALUES (?, ?, ?)',
	  undef,
	  $wa, $wa1, $wa2);
}

if($wybor==3)
{
	say "ID:"; 
		my $id = <STDIN>; 
		say""; chomp 
		$id;

	say "Dane1:"; 
		my $w = <STDIN>; 
		say""; chomp 
		$w;

	say "Dane2:"; 
		my $w1 = <STDIN>; 
		say""; chomp 
		$w1;

	say "Liczba:"; 
		my $w2 = <STDIN>; 
		say""; 
		chomp $w2;
	

		 
		$dbh->do('UPDATE dane SET dana1 = ?, dana2 = ?, liczba = ? WHERE id = ?',
		  undef,
		  $w,
		  $w1,
		  $w2,
		  $id);
}

if($wybor==4)
{
	my $nowatabela = $dbh->prepare('CREATE TABLE perl.dane(id INT NOT NULL AUTO_INCREMENT ,dana1 char(20), dana2 char(20), liczba int, PRIMARY KEY (`id`));') 
                 or 
                 die "Nie mogę utworzyć tabeli: " . $dbh->errstr();
	$nowatabela->execute() 
	          or 
	          die "Can't execute SQL: " . $nowatabela->errstr();
	#metoda disconnect odwołuje się do DBI::db
	$dbh->disconnect();
	say "Utworzono Tabele dane";
}	

if($wybor==5)
{
	$dbh->do('DROP TABLE dane');
	say "Usunieto tabele";
}

if($wybor==0)
{
	say "Koniec";
}