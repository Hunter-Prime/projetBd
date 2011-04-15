<?php session_start();
include_once($_SESSION['chemin']."/metier/Systeme.class.php");
$id = $_GET['id'];
if($id == "CIE"){
	$systeme = new Systeme("e084857l", "mysql.ensinfo.sciences.univ-nantes.prive", "e084857l", "26523579");
} else {
	if (strpos(getenv("HTTP_USER_AGENT"), "Win")){
		$systeme = new Systeme("projetbdd", "127.0.0.1:8888", "root", "");
	}elseif (strpos(getenv("HTTP_USER_AGENT"), "Linux")){
		$systeme = new Systeme("projetBDD", "127.0.0.1", "root", "root");
	}
}
$_SESSION['systeme'] = serialize($systeme);
?>
