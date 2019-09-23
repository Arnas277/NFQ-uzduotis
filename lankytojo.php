<?php
session_start();
//Lankytojo puslapis skirtas lankytojui registruoti vizitus pas specialistus, juos peržiūrėti ar trinti.
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
                    $('#table').load('add/run2.php');
                }, 5000);
			});
	</script>
</head>
<body>";
if (!isset($_SESSION['privardas'])) {
	//Rodo jei vartotojas nėra prisijungęs
	echo "
		<div>
			<center><p>Prisijungti</p></center>
			<form action='priklienta.php'  method='POST'>
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
	//Rodo lentelę su artėjančiais vizitais ir likusiu laiku, atnaujinama kas 5s
	echo "
		<div id='refresh'>
			<center><p>Sveiki <b>".$_SESSION['vardas']."</b>.</p>
			<p>Artėjantys vizitai:</p><div id='table'></div>";
			//Galimybė registruoti nauja vizitą
			echo "
				<hr>
					<form action='regvizita.php'  method='GET'>
					<div class='container'>
					<p>Užregistruoti naują vizitą:</p>
						".$_SESSION['vizitoklaida']."
					<hr>
					<label for='skyrius'><b>Pasirinkite skyrių:</b></label>
					  <select name='skyrius'>
						<option value='Valiutos Keitimas'>Valiutos keitimas</option>
						<option value='Paskolos'>Paskolos</option>
						<option value='Kasdienes Paslaugos'>Kasdienės paslaugos</option>
						<option value='Verslo Klientai'>Verslo klientai</option>
					  </select><br>
					  <label for='data'><b>Pasirinkite datą:</b></label>
					  <input type='date' name='data'>
					  <br>
					<button type='submit' class='registerbtn'>Registruoti</button>
				  </div></form>
				  <br><hr>
					<a href='atsijungti.php'>Atsijungti</a>
			</center>
		</div>
	";
}
include "include/footer.php";

?>