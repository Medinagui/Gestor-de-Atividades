<?php 
	session_start(
        ['cookie_lifetime' => 60 * 60 * 24]
    );
	//session_start();
	
	if ($_POST["operation"] == 'load') {
		
		if (isset($_SESSION["login"])) {
			echo '{ "nome" : "' . $_SESSION["nome"] . 
			'", "login" : "' . $_SESSION["login"] . '" }';
		} else {
			echo '{ "nome" : "undefined" }';
		}
		
	} else if ($_POST["operation"] == 'login') {
		
		$_SESSION["nome"] = $_POST["nome"];
		$_SESSION["login"] = $_POST["login"];
		$_SESSION["senha"] = $_POST["senha"];
		echo '{ "nome" : "' . $_SESSION["nome"] . 
			'", "login" : "' . $_SESSION["login"] . '" }';
			
	} else if ($_POST["operation"] == 'logout') {
		
		session_destroy();
		echo '{ "nome" : "undefined" }';
		
	} else {
		
		echo '{ "invalid_operation" : "' . $_POST["operation"] . '" }';
		
	}
?>