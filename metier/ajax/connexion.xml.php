<?php session_start();
	header("Content-Type: text/xml");
	include_once($_SESSION['chemin']."/metier/Systeme.class.php");
	$systeme = unserialize($_SESSION['systeme']);
	if(isset($_GET['login']) && isset($_GET['password'])){
		$login = $_GET['login'];
		$pass = $_GET['password'];
		//var_dump($systeme);
		$test = $systeme->checkUser($login, $pass);
#		var_dump($test);
		if($test){
			
			$res = $systeme->getType($login, $pass);
#			var_dump($res);
			echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	
			echo"<list>";
			echo"	<item user=\"".$login."\" type=\"".$res."\" />\n";
			echo"</list>";
			$_SESSION['user'] = $login;
			if($res=="administrateur"){
				$_SESSION['logged'] = "admin";
			} else {
				$_SESSION['logged'] = "utilisateur";
			}
			$_SESSION['connexion'] = true;
		}
	}
?>
