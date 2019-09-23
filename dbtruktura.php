<?php
include "dbconfig.php";

//Lentelė registruotiems lankytojams
$query = "CREATE TABLE lankytojai (
	id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	privardas VARCHAR(20) NOT NULL,
	slaptazodis VARCHAR(32) NOT NULL,
	vardas VARCHAR(30),
	pavarde VARCHAR(30)
	)";
$result = mysqli_query($db,$query);

//Lentelė registruotiems specialistams
$query = "CREATE TABLE specialistai (
	id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	privardas VARCHAR(30) NOT NULL,
	slaptazodis VARCHAR(32) NOT NULL,
	idspec INT(3),
	)";
$result = mysqli_query($db,$query);

//Lentelė saugoti specialistu informacijai
$query = "CREATE TABLE specialistuinfo (
	id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	specid INT(3), 
	vardas VARCHAR(20) NOT NULL,
	pavarde VARCHAR(20) NOT NULL,
	skyrius VARCHAR(20),
	vizitotrukme int(3)
	)";
$result = mysqli_query($db,$query);

//Lentelė vizitams saugoti
$query = "CREATE TABLE vizitai (
	id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	vartotojoid INT(5) NOT NULL,
	specialistoid INT(3) NOT NULL,
	data DATE,
	laikas TIME,
	aptarnautas TINYINT(1),
	trukme INT(3)
	)";
$result = mysqli_query($db,$query);
?>