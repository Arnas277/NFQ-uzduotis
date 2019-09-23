<?php
//Failas skirtas lentelei specialisto puslapyje
session_start();
include "../dbconfig.php";
			$id = $_SESSION['id'];
			$query = "SELECT * FROM `vizitai` WHERE specialistoid='$id' ORDER BY data, laikas";
			$result = mysqli_query($db, $query);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck < 1) {
				echo "Jūs neturite artėjančių vizitų.";
			} else {
				echo "<table><tr><th>Data</th><th>Laikas</th><th>Klientas</th><th>Atliktas</th></tr>";
				while ($row = mysqli_fetch_assoc($result)) {
					$specid = $row['vartotojoid'];
					$query2 = "SELECT * FROM `lankytojai` WHERE id='$specid'";
					$result2 = mysqli_query($db, $query2);
					$row2 = mysqli_fetch_assoc($result2);
					echo "<tr><td>" . $row['data'] . "</td><td>" . $row['laikas'] . "</td><td>" . $row2['vardas'] . " " . $row2['pavarde'] . "</td><td><form action='updatepost.php' method='POST'><button name='subject' type='submit' value='" . $row['id'] . "'>Atliktas</button></form></td></tr>";
				} echo "</table>";
			}
?>