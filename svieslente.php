<?php
//Svieslente rodo dabartini laika ir artėjanėius neatliktus vizitus.
session_start();
include "dbconfig.php";
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
                    $('#table').load('add/run.php');
                }, 5000);
			});
			var myVar = setInterval(myTimer ,1000);
			function myTimer() {
			  var d = new Date();
			  document.getElementById('demo').innerHTML = d.toLocaleTimeString();
			}	
	</script>
</head>
<body>";

echo "
<center><h1>Laikrodis</h1>
<p id='demo'></p><div id='table'></div></center>";

include "include/footer.php";
?>