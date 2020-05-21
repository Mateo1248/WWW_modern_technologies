<?php 
$db["Host"] = "localhost";
$db["User"] = "siteClient";
$db["Password"] = "clientPasswd123";
$db["Name"] = "ntwww";

global $logged;
$logged = false;
 
function connect() {
	global $pdo;
	global $db; 
	
	try {
		$pdo = new PDO('mysql:host='.$db["Host"].';dbname='.$db["Name"], $db["User"], $db["Password"]);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch(PDOException $error) {
		echo $error->getMessage();
	}
}
?>