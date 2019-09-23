<?php
session_start();
include "dbconfig.php";
include "include/head.php";

// Vykdoma kai registruojamas naujas apsilankymas
if (isset($_POST['skyrius'])) {
			$skyrius = $_POST['skyrius'];
			$vardas = $_POST['vardas'];
			$laikasdb = date("H:i:s");
			$datadb = date("Y-m-d");
			$query = "SELECT * FROM `specialistuinfo` WHERE skyrius='$skyrius'";
			$result = mysqli_query($db, $query);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck == 1) {
				// jei tas skyrius turi tik viena specialista
				$row1 = mysqli_fetch_assoc($result);
				$specid = $row1['specid'];
				$query2 = "SELECT * FROM `vizitai` WHERE specialistoid='$specid' AND data='$datadb' ORDER BY laikas DESC LIMIT 1";
				$result2 = mysqli_query($db,$query2);
				$row2 = mysqli_fetch_assoc($result2);
				if (mysqli_num_rows($result2) == 0) {
					$row2['laikas'] = "08:00:00";
				}
				if ($row2['laikas'] > $laikasdb) {
					$paskutinisvizitas = $row2['laikas'];
					//check vizito trukme
						$query3 = "SELECT * FROM `specialistuinfo` WHERE specid='$specid'";
						$result3 = mysqli_query($db,$query3);
						$row3 = mysqli_fetch_assoc($result3);
						$trukme = $row3['vizitotrukme'];
						$kitasvizitas = date("H:i:s", strtotime($paskutinisvizitas)+($trukme*60));
						$query4 = "INSERT INTO `vizitai` (vardas, specialistoid, data, laikas, aptarnautas, trukme) 
						VALUES('".$vardas."','".$specid."','".$datadb."', '".$kitasvizitas."', '0', '0')";
						$result4 = mysqli_query($db,$query4);
				} else {
						$kitasvizitas = date("H:i:s", strtotime($laikasdb)+60);
						$query4 = "INSERT INTO `vizitai` (vardas, specialistoid, data, laikas, aptarnautas, trukme) 
						VALUES('".$vardas."','".$specid."','".$datadb."', '".$kitasvizitas."', '0', '0')";
						$result4 = mysqli_query($db,$query4);
				}
			} else {
				// Jei banko skyrius turi daugiau nei vieną specialistą išrinks mažiausiai vizitų turintį ir jam priskirs naują vizitą
				$datas = array();
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$datas[] = $row;
						}
					}
						$rows = 1000;
						$specid = 0;
					foreach ($datas as $data) {
							$nr = $data['specid'];
							$query = "SELECT * FROM `vizitai` WHERE specialistoid='$nr' AND data='$datadb'";
							$result = mysqli_query($db, $query);
						if (mysqli_num_rows($result) < $rows) {
							$rows = mysqli_num_rows($result);
							$specid = $nr;
						}
					}
				$query2 = "SELECT * FROM `vizitai` WHERE specialistoid='$specid' AND data='$datadb' ORDER BY laikas DESC LIMIT 1";
				$result2 = mysqli_query($db,$query2);
				$row2 = mysqli_fetch_assoc($result2);
				if (mysqli_num_rows($result2) == 0) {
					$row2['laikas'] = "08:00:00";
				}
				if ($row2['laikas'] > $laikasdb) {
					$paskutinisvizitas = $row2['laikas'];
						$query3 = "SELECT * FROM `specialistuinfo` WHERE specid='$specid'";
						$result3 = mysqli_query($db,$query3);
						$row3 = mysqli_fetch_assoc($result3);
						$trukme = $row3['vizitotrukme'];
						$kitasvizitas = date("H:i:s", strtotime($paskutinisvizitas)+($trukme*60));
						$query4 = "INSERT INTO `vizitai` (vardas, specialistoid, data, laikas, aptarnautas, trukme) 
						VALUES('".$vardas."','".$specid."','".$datadb."', '".$kitasvizitas."', '0', '0')";
						$result4 = mysqli_query($db,$query4);
				} else {
						$kitasvizitas = date("H:i:s", strtotime($laikasdb)+60);
						$query4 = "INSERT INTO `vizitai` (vardas, specialistoid, data, laikas, aptarnautas, trukme) 
						VALUES('".$vardas."','".$specid."','".$datadb."', '".$kitasvizitas."', '0', '0')";
						$result4 = mysqli_query($db,$query4);
				}
			}
			
	if (!isset($_SESSION['naujasvizitas'])) {
				$query10 = "SELECT * FROM `vizitai` WHERE vardas='$vardas' ORDER BY id DESC LIMIT 1";
				$result10 = mysqli_query($db,$query10);
				$row10 = mysqli_fetch_assoc($result10);
				$_SESSION['naujasvizitas'] = "Jūs sėkmingai užregistravote vizitą. Vizito nr: <b>" . $row10['id'] . "</b>";
	}
}
// Puslapio struktūra
echo "
				<form action='gauknr.php'  method='POST'>
					<div class='container'>
					<p>Užregistruoti naują vizitą:</p>
						".$_SESSION['naujasvizitas']."
					<hr>
					<label for='skyrius'><b>Pasirinkite skyrių:</b></label>
					  <select name='skyrius'>
						<option value='Valiutos Keitimas'>Valiutos keitimas</option>
						<option value='Paskolos'>Paskolos</option>
						<option value='Kasdienes Paslaugos'>Kasdienės paslaugos</option>
						<option value='Verslo Klientai'>Verslo klientai</option>
					  </select><br>
					  <label for='vardas'><b>Iveskite savo vardą:</b></label>
						<input type='text' placeholder='Jūsų vardas' name='vardas' required>

					  <br>
					<button type='submit' class='registerbtn'>Registruoti</button>
				  </div></form>";
unset ($_SESSION['naujasvizitas']);
include "include/footer.php";
?>