<?php
session_start();
if (!isset($_SESSION['privardas'])) {
include 'include/head.php';
//Puslapis vartotojams/klientams registruotis (užsiregistravus vartotojas turi galimybę peržiurėti visus savo vizitus, ar juos atšaukti)
echo "
	<div>
		<center><p>Registracija</p></center>
		 <form action='regklienta.php'  method='POST'>
		  <div class='container'>
			<p>Prašome užpildyti visus žemiau esančius laukelius.</p>
				".$_SESSION['regklaida']."
			<hr>

			<label for='privardas'><b>Prisijungimo vardas</b></label>
			<input type='text' placeholder='Jūsų Prisijungimo Vardas' name='privardas' required>

			<label for='slaptazodis1'><b>Slaptažodis</b></label>
			<input type='password' placeholder='Jūsų slaptažodis' name='slaptazodis1' required>

			<label for='slaptazodis2'><b>Pakartokite slaptažodį</b></label>
			<input type='password' placeholder='Pakartokite slaptažodį' name='slaptazodis2' required>
			
			<label for='vardas'><b>Vardas</b></label>
			<input type='text' placeholder='Jūsų Vardas' name='vardas' required>
			
			<label for='pavarde'><b>Pavardė</b></label>
			<input type='text' placeholder='Jūsų Pavardė' name='pavarde' required>
			<hr>

			<button type='submit' class='registerbtn'>Registruotis</button>
		  </div>
	</div>
";

include "include/footer.php";
} else {
	header('location: lankytojo.php');
}
?>