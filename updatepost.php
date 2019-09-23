<?php
session_start();
		//Failas skirtas kai specialistas pažymi jog vizitas pasibaigė.
		//Jis taip pat tikrina kiek truko vizitas ir informacija atnaujina duomenų bazėje.
			include "dbconfig.php";
			$id = $_POST['subject'];
			$query2 = "SELECT * FROM `vizitai` WHERE id='$id'";
			$result2 = mysqli_query($db, $query2);
			$row2 = mysqli_fetch_assoc($result2);
			$laikas = $row2['laikas'];
			$date1 = strtotime($laikas);
				$now_timestamp = strtotime(date('H:i:s'));
				 $diff_timestamp = $now_timestamp - strtotime($laikas);
				 $mins = $diff_timestamp/60;
				 $mins = round($mins);
				$query = "UPDATE `vizitai` SET aptarnautas=1 WHERE id='$id'";
				$result = mysqli_query($db, $query);
				$query = "UPDATE `vizitai` SET trukme='$mins' WHERE id='$id'";
				$result = mysqli_query($db, $query);
			
			header('location: specialistams.php');

?>