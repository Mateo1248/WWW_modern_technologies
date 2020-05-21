<?php

 
class Authorization {
 
private $_email;
private $_password;
private $_dbpdo;
 
public function __construct() {
	try {
		global $pdo;
		$this->_dbpdo = $pdo;
	} 
	catch(PDOException $error) {
		return $error->getMessage();
	}
}
 
public function setEmail($email) {
	$this->_email = $email;
}
 
public function setPassword($password) {
	$this->_password = $password; 
}
 
public function getEmail() {
	return $this->_email;
}
 
public function getPassword() {
	return $this->_password;
}
 
public function validateUsr() {
	if ( ($this->getEmail())=='' || ($this->getPassword())=='' ) {
		return false;
	} 
	return true;	
}
 
public function Hash() {
	return sha1(md5($this->getPassword().$this->getPassword()));
}
 
public function Login() {
	$password = $this->Hash();

	$sql = $this->_dbpdo->prepare("SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1");
	$sql->bindValue(':email',$this->getEmail(),PDO::PARAM_STR);
	$sql->bindValue(':password',$password,PDO::PARAM_STR);
	$sql->execute();
 
	if ($row = $sql->fetch()) {
		session_start();
		$_SESSION['id_usr'] = $row['id'];
		$_SESSION['login_usr'] = $row['login'];
	 
		ini_set('session.cookie_httponly', 1); 
		return true; 
	} 
	else {
		return false;
	}
	
	$sql->closeCursor();
}
	 
public function LogOut() {
	session_start();
	session_unset(); 
	session_destroy(); 
}
}
 
?>