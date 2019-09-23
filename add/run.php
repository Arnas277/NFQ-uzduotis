<?php
//Failas lentelei svieslentėje
session_start();
include "../dbconfig.php";
		$id = $_SESSION['id'];
		$query = "SELECT * FROM `vizitai` WHERE aptarnautas=0 ORDER BY data ASC, laikas ASC LIMIT 10";
			$result = mysqli_query($db, $query);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck < 1)  {
				echo "<p>Nera jokių artėjančių apsilankymų.</p>";
			} else {
				echo "<center><table><tr><th>Lankytojas</th><th>Data</th><th>Numatomas laikas</th><th>Liko</th><th>Specialistas</th><th>Skyrius</th></tr>";
				while ($row = mysqli_fetch_assoc($result)) {
					$specid = $row['specialistoid'];
					$vartotojoid = $row['vartotojoid'];
					//---------------------
					$query2 = "SELECT * FROM `specialistuinfo` WHERE specid='$specid'";
					$result2 = mysqli_query($db, $query2);
					$row2 = mysqli_fetch_assoc($result2);
					//---------------------
					if (!empty($vartotojoid)) {
					$query3 = "SELECT * FROM `lankytojai` WHERE id='$vartotojoid'";
					$result3 = mysqli_query($db, $query3);
					$row3 = mysqli_fetch_assoc($result3);
					$vardas = $row3['vardas'];
					} else {
						$vardas = $row['vardas'];
					}
					$datadb = date("Y-m-d");
					if ($datadb == $row['data']) {
					$laikasdb = date("H:i:s");
					if($laikasdb > $row['laikas']){
						$likeslaikas = "Jau praėjo";
					} else {
					$likeslaikas = date("H:i:s", strtotime($laikasdb) - strtotime($row['laikas']));
					}
					} else {
						$likeslaikas = "Ne šiandien";
					}
					echo "<tr><td>" . $vardas . "</td><td>" . $row['data'] . "</td><td>" . $row['laikas'] . "</td><td>".$likeslaikas."</td><td>" . $row2['vardas'] . " " . $row2['pavarde'] . "</td><td>" . $row2['skyrius'] . "</td></tr>";
				} echo "</table></center>";
			}
?>