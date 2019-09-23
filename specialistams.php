<?php
//Puslapis skirtas specialistams, čia jie galės matyti artėjančius vizitus, duomenis apie juos ir pažymėti kai vizitas bus atliktas. 
//Lentelė su vizitais atnaujinama kas 5s
session_start();
echo "
<html>
<head>
<meta charset='utf-8'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
	<meta name='description' content='Kumelio Kojos bankas'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	 <link rel='stylesheet' type='text/css' href='css/main.css'> 
	<title>Kumelio Kojos bankas</title>
	<script type='text/javascript'>
			$(document).ready(
            function() {
                setInterval(function() {
                    $('#table').load('add/run3.php');
                }, 5000);
			});
	</script>
</head>
<body>";
if (!isset($_SESSION['privardas'])) {
	echo "
		<div>
			<center><p>Prisijungti</p></center>
			<form action='prispecialista.php'  method='POST'>
			<div class='container'>
			<p>Prašome užpildyti visus žemiau esančius laukelius.</p>
				".$_SESSION['priklaida']."
			<hr>

			<label for='privardas'><b>Prisijungimo vardas</b></label>
			<input type='text' placeholder='Jūsų Prisijungimo Vardas' name='privardas' required>

			<label for='slaptazodis1'><b>Slaptažodis</b></label>
			<input type='password' placeholder='Jūsų slaptažodis' name='slaptazodis1' required>

			<button type='submit' class='registerbtn'>Prisijungti</button>
		  </div>
		</div>
	";
} else {
	echo "
		<div id='refresh'>
			<center><p>Sveiki <b>".$_SESSION['vardas']."</b>.</p>
			<p>Artėjantys vizitai:</p><div id='table'></div>";
			echo "
				<hr>
					<a href='atsijungti.php'>Atsijungti</a>
			</center>
		</div>
	";
}
include "include/footer.php";

?>