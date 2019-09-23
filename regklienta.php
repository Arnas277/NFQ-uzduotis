<?php
//Failas skirtas patikrinti informacijai kai klientas registruojasi
session_start();
include "dbconfig.php";
unset ($_SESSION['regklaida']);
if (!isset($_SESSION['privardas'])) {

$privardas = $_POST['privardas'];
$slaptazodis1 = $_POST['slaptazodis1'];
$slaptazodis2 = $_POST['slaptazodis2'];
$vardas = $_POST['vardas'];
$pavarde = $_POST['pavarde'];
$privardas = strtolower($privardas);

if (empty($privardas) || empty($slaptazodis1) || empty($slaptazodis2) || empty($vardas) || empty($pavarde)) {
	$_SESSION['regklaida'] = "Visi laukeliai turi būti užpildyti!";
}

if ($slaptazodis1 != $slaptazodis2) {
	$_SESSION['regklaida'] = "Slaptažodžiai nesutampa!";
}

$user_check_query = "SELECT * FROM `lankytojai` WHERE `privardas`='".$privardas."' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
 $user = mysqli_fetch_assoc($result);
  
 if ($user['privardas'] === $privardas) {
		$_SESSION['regklaida'] = "Toks vartotojas jau egzistuoja, prašome pasirinkti kitą prisijungimo vardą!";
}
if (isset($_SESSION['regklaida'])) {
	header('location: klientams.php');
} else {
	  $slaptazodis1 = md5($slaptazodis1);
		$query = "INSERT INTO `lankytojai` (privardas, slaptazodis, vardas, pavarde) 
  			  VALUES('".$privardas."', '".$slaptazodis1."', '".$vardas."', '".$pavarde."')";
		mysqli_query($db, $query);
	header('location: lankytojo.php');
}
} else {
	header('location: klientams.php');
}
?>