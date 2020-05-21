<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">
    <title>Zakamarki kryptografii</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="favic.jpeg">
</head>
<body>
	<header>
        <h1>Aby móc korzystać ze strony zaloguj lub zarejestruj się.</h1>
    </header>
    <main>
    	<div id="registration" class="panel">
   			<div class="hContainer">
   				<h1>Rejestracja</h1>
   			</div>
   			<ul>
   				<?php
				require_once 'config.php';

				if (isset($_POST["register"])) { 
					connect(); 
					 
					$firstname = strip_tags(trim($_POST["firstname"]));
					$surname = strip_tags(trim($_POST["surname"]));
					$email = strip_tags(trim($_POST["email"]));
					$password = strip_tags(trim($_POST["password"]));
					   
					$password_hash = sha1(md5($password.$password));

					$add = $pdo->exec("INSERT INTO users (firstname, surname, email, password) VALUES ('$firstname', '$surname', '$email','$password_hash')");
					$add->closeCursor(); 

					header('Location: login.php'); 
				}
	 
				?>
   				<form method="post">
	   				<li>
	   					<label for="firstname">Imię:</label>
						<input type="text" id="firstname" name="firstname" maxlength="255" required>
	   				</li>
	   				<li>
	   					<label for="surname">Nazwisko:</label>
	   					<input type="text" id="surname" name="surname" maxlength="255" required>
	   				</li>
	   				<li>
	   					<label for="email">E-mail:</label>
						<input type="text" id="email" name="email" maxlength="255" required>
	   				</li>
	   				<li>
	   					<label for="password">Hasło:</label>
	   					<input type="password" id="password" name="password" maxlength="255" required>
	   				</li>
	   				<li class="btnContainer">
	   					<input class="button" type="submit" value="Register" name="register">	
	   				</li>
	    		</form>
	    		<li>
	    			<a href="login.php"class="panelLinks">Masz już konto? Kliknij tutaj!</a>
	    		</li>
   			</ul>
   		</div>

   		<div id="stat">
   		</div>
   	<main>
</body>
</html>