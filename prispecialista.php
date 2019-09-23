<?php
//Specialistų prisijungimo failas, patikrina informaciją ir jei viskas tvarkoje - specialisto prisijungimo duomenis išsaugo globaliame kintamajame $_SESSION
session_start();
unset ($_SESSION['priklaida']);
if (!isset($_SESSION['privardas'])) {
$db = mysqli_connect('localhost','vrnlt_nfq','ArnasSidlauskas1', 'vrnlt_nfq');
$privardas = mysqli_real_escape_string($db, $_POST['privardas']);
$slaptazodis1 = mysqli_real_escape_string($db, $_POST['slaptazodis1']);
$privardas = strtolower($privardas);

if (empty($privardas) || empty($slaptazodis1)) {
	$_SESSION['priklaida'] = "Visi laukeliai turi būti užpildyti!";
}
if (!isset($_SESSION['priklaida'])) {
		$slaptazodis1 = md5($slaptazodis1);
		$query = "SELECT * FROM `specialistai` WHERE privardas='$privardas' AND slaptazodis='$slaptazodis1'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 1) {
				$results = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$_SESSION['id'] = $results['id'];
				$specid = $results['id'];
				$_SESSION['privardas'] = ucwords($privardas);
				$query = "SELECT * FROM `specialistuinfo` WHERE specid='$specid'";
				$result = mysqli_query($db, $query);
				$results2 = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$_SESSION['vardas'] = $results2['vardas'];
				$_SESSION['pavarde'] = $results2['pavarde'];
				$_SESSION['skyrius'] = $results2['skyrius'];
				$_SESSION['vizitotrukme'] = $results2['vizitotrukme']; 
			header('location: specialistams.php');
		}
		
} else {
	header('location: specialistams.php');
}
}
?>