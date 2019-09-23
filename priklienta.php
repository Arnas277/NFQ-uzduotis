<?php
//Vartotojų prisijungimo failas, patikrina informaciją ir jei viskas tvarkoje - vartotojo prisijungimo duomenis išsaugo globaliame kintamajame $_SESSION
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
		$query = "SELECT * FROM `lankytojai` WHERE privardas='$privardas' AND slaptazodis='$slaptazodis1'";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 1) {
				$results = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$_SESSION['id'] = $results['id'];
				$_SESSION['privardas'] = ucwords($privardas);
				$_SESSION['vardas'] = $results['vardas'];
				$_SESSION['pavarde'] = $results['pavarde'];
			header('location: lankytojo.php');
		}
		
} else {
	header('location: lankytojo.php');
}
}
?>