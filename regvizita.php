<?php
//Failas skirtas u=registruoti naują vizitą
session_start();
unset ($_SESSION['vizitoklaida']);
if (isset($_SESSION['privardas'])) {
	
	include "dbconfig.php";
	$skyrius = $_GET['skyrius'];
	$vdata = $_GET['data'];
	if (date("Y-m-d")>$vdata){
		$_SESSION['vizitoklaida'] = "Pasirinkite kitą datą!";
	}
	if (empty($skyrius) || empty($vdata)) {
		$_SESSION['vizitoklaida'] = "Visi laukeliai turi būti užpildyti! Kreipkis telefonu: +37065219432";
	}
	if (!isset($_SESSION['vizitoklaida'])) {
					//Patikrina mažiausiai užintą specialistą pasirinktame skyriuje
					$query = "SELECT * FROM `specialistuinfo` WHERE skyrius='$skyrius'";
					$result = mysqli_query($db, $query);
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
							$query = "SELECT * FROM `vizitai` WHERE specialistoid='$nr' AND data='$vdata'";
							$result = mysqli_query($db, $query);
						if (mysqli_num_rows($result) < $rows) {
							$rows = mysqli_num_rows($result);
							$specid = $nr;
						}
					}
					if ($rows == 0) {
						//Jei vizitų pas tą specialistą ta dieną dar neregistruota, pradeda registruoti nuo 08:00
						$kitovizitolaikas = "08:00:00";
					} else {
					$query = "SELECT * FROM `vizitai` WHERE specialistoid='$specid' AND data='$vdata' ORDER BY laikas DESC LIMIT 1";
					$result = mysqli_query($db, $query);
					$results = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$paskutvizlaikas = $results['laikas'];
					
				// suranda kiek trunka vidutiniskai pasirinkto specialisto vizitas
					$query = "SELECT * FROM `specialistuinfo` WHERE specid='$specid'";
					$result = mysqli_query($db, $query);
					$results = mysqli_fetch_array($result,MYSQLI_ASSOC);
					$minutes = $results['vizitotrukme'];
					
					$kitovizitolaikas = date("H:i:s", strtotime($paskutvizlaikas)+($minutes*60));
					}
					//Jei laukiančių vizitų nėra - registruos iš karto
					if(date("H:i:s")>$kitasvizitolaikas)
						{
							if (date("Y-m-d")==$vdata){
							$kitovizitolaikas = date("H:i:s");}
						}
					$query = "INSERT INTO `vizitai` (vartotojoid, specialistoid, data, laikas, aptarnautas, trukme) 
						VALUES('".$_SESSION['id']."', '".$specid."', '".$vdata."', '".$kitovizitolaikas."', '0', '0')";
						$result = mysqli_query($db, $query);
						$_SESSION['vizitoklaida'] = "Vizitas sėkmingai užregistruotas!";
					header('location: lankytojo.php');
					
			}
	header('location: lankytojo.php');			
	} else {
		header('location: lankytojo.php');
	}
?>