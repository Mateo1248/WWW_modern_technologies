
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
	<?php
	require_once 'config.php'; 
 
	if (isset($_POST["login"])) {
 
		connect(); 
		require_once 'class.Authorization.php'; 
		 
		$user = strip_tags(trim($_POST["user"]));
		$password = strip_tags(trim($_POST["password"]));
		 
		$log = new Authorization();
		$log->setUser($user);
		$log->setPassword($password);
		 
		if (!$log->validateUsr()) {
			echo '<p class="error">Wprowadź login i hasło!</p>'; 
		} else if (!$log->Login()) {
			echo '<p class="error">Nieprawidłowy login i/lub hasło!</p>'; 
		} else {
			session_start();
			$logged = true;
			header('Location: index.html'); 
		}
	}
	?>
	<header>
        <h1>Aby móc korzystać ze strony zaloguj lub zarejestruj się.</h1>
    </header>
    <main>
    	<div  id="login" class="panel">
    		<div class="hContainer">
    			<h1>Logowanie</h1>
    		</div>
    		<ul>
    			<form method="post">
	    			<li>
	    				<label for="user">E-mail:</label>
						<input type="text" id="user" name="user" maxlength="255" required autofocus>
	    			</li>
	    			<li>
	    				<label for="password">Hasło:</label>
	    				<input type="password" id="password" name="password" maxlength="255" required>
	    			</li>
	    			<li class="btnContainer">
	    				<input class="button" type="submit" value="Login" name="login">
	    			</li>
	    		</form>

	    		<li>
	    			<a href="registration.php" class="panelLinks">Nie posiadasz jeszcze konta? Kliknij tutaj!</a>
	    		</li>
    		</ul>
    	</div>
    	</div>
   		<div id="stat">
   		</div>
   	<main>
</body>
</html>