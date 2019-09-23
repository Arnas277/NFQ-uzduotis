<?php
//Failas skirtas lentelei vartotojo puslapyje
session_start();
			include "../dbconfig.php";
			$id = $_SESSION['id'];
			$query = "SELECT * FROM `vizitai` WHERE vartotojoid='$id' AND aptarnautas=0 ORDER BY laikas";
			$result = mysqli_query($db, $query);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck < 1) {
				echo "Jūs neturite artėjančių vizitų.";
			} else {
				echo "<table><b><tr><th>Data</th><th>Laikas</th><th>Liko</th><th>Specialistas</th><th>Skyrius</th><th>Pašalinti</th></tr></b>";
				while ($row = mysqli_fetch_assoc($result)) {
					$specid = $row['specialistoid'];
					$query2 = "SELECT * FROM `specialistuinfo` WHERE specid='$specid'";
					$result2 = mysqli_query($db, $query2);
					$row2 = mysqli_fetch_assoc($result2);
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
					echo "<tr><td>" . $row['data'] . "</td><td>" . $row['laikas'] . "</td><td>".$likeslaikas."</td><td>" . $row2['vardas'] . " " . $row2['pavarde'] . "</td><td>" . $row2['skyrius'] . "</td><td><form action='trinti.php' method='POST'><button name='subject' type='submit' value='" . $row['id'] . "'>Ištrinti</button></form></td></tr>";
				} echo "</table>";
			}
?>