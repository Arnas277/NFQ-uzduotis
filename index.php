<?php
session_start();
include "include/head.php";

echo "
	<div>
		<center><p><img src='logo.jpg' style='border-radius:70px;'></img><br>Sveiki atvykę į Kumelio Kojos banko klientų aptarnavimo sistemą. <br>Pasirinkite paslaugą:</p></center>
	</div>
	<div class='meniu'>
	<center>";
		if (!isset($_SESSION['privardas'])) {
			//Rodo tik kai klientas yra prisijungęs
			echo "
				<a href='klientams.php'>Registracija vartotojams</a>";
		}
		echo "
				<a href='lankytojo.php'>Vartotojo meniu</a>
				<a href='gauknr.php'>Užregistruok vizitą</a>
				<a href='patikrink.php'>Kiek liko iki apsilankymo?</a>
				<br><br>";
		if (isset($_SESSION['privardas'])) {
			//Rodo tik kai klientas yra prisijungęs
			echo "
				<a href='atsijungti.php'>Atsijungti</a>";
			}
		echo "
	</center>
	</div>
";

include "include/footer.php";

?>