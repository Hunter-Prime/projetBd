<?php

class Bd{

	private $bdName;
	private $host;
	private $user;
	private $password;
	private $connect;
	
	function __construct($bdName, $host, $user, $password){
		$this->bdName = $bdName;
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
	}
	
	function connexion(){
		
		if (strpos(getenv("HTTP_USER_AGENT"), "Win")){
			$this->connect = mysql_connect($this->host, $this->user, "mysql");
		} else $this->connect = mysql_connect($this->host, $this->user, $this->password);
		if(!$this->connect) {
			die('Impossible de se connecter : ' . mysql_error());
		}
		
		$bdSelected = mysql_select_db($this->bdName, $this->connect);
		if(!$bdSelected){
			die('Impossible de selectionner la base de données :' . mysql_error());
		}
	}
	
	function deconnexion(){
		mysql_close($this->connect);
	}
	
	function query($requete){
		$this->connexion();
		
		$result = mysql_query($requete, $this->connect);
		//$this->deconnexion();
		
		return $result;
	}
	
	function getUser(){
		return $this->user;
	}
	
	function setAll($bdName, $host, $user, $password){
		$this->bdName = $bdName;
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
	}

}
?>
