<?php
session_start();
//Failas skirtas prisijungusiems vartotojams norintiems ištrinti vieną ar kitą savo vizitą
	include "dbconfig.php";
	$id = $_POST['subject'];
	$query = "DELETE FROM `vizitai` WHERE id='$id'";
	$result2 = mysqli_query($db, $query);		
	header('location: lankytojo.php');

?>