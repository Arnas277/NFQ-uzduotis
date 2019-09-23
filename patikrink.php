<?php
// Puslapis skirtas patikrinti artėjančio vizito informaciją turint vizito ID
session_start();
include "dbconfig.php";
if (!isset($_SESSION['privardas'])) {
include 'include/head.php';

echo "
	<div>
		<center><p>Pasitikrink</p></center>
		 <form action='patikrink.php'  method='POST'>
		  <div class='container'>

				".$_SESSION['pasiklaida']."
			<hr>
			<label for='privardas'><b>Jūsų apsilankymo numeris:</b></label>
			<input type='text' placeholder='Numeris' name='numeris' required>
			<hr>

			<button type='submit' class='registerbtn'>Patikrink</button>
		  </div>
	</div>
";
if (isset($_POST['numeris'])){
	$id = $_POST['numeris'];
	$query2 = "SELECT * FROM `vizitai` WHERE id='$id'";
	$result2 = mysqli_query($db, $query2);
	$row2 = mysqli_fetch_assoc($result2);
	$datadb = date("Y-m-d");
					if ($datadb == $row2['data']) {
					$laikasdb = date("H:i:s");
					if($laikasdb > $row2['laikas']){
						$likeslaikas = "Jau praėjo";
					} else {
					$likeslaikas = date("H:i:s", strtotime($laikasdb) - strtotime($row2['laikas']));
					}
					} else {
						$likeslaikas = "Ne šiandien";
					}
	echo "<center><table><tr><th>Numeris</th><th>Data</th><th>Laikas</th><th>Liko</th></tr>
			<tr><td>".$row2['id']."</td><td>".$row2['data']."</td><td>".$row2['laikas']."</td><td>".$likeslaikas."</td></tr></table><center>";
}
include "include/footer.php";
} else {
	header('location: lankytojo.php');
}
?>