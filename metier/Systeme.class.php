<?php

include_once($_SESSION['chemin']."/bd/Bd.class.php");

class Systeme{

	private $bd;
	
	function __construct($bdname, $host, $user, $pass){
		$this->bd = new Bd($bdname, $host, $user, $pass);
	}
	
	function checkUser($login, $pass){
		$res = $this->bd->query("select `pseudo`, `motdepasse` from Utilisateurs");
		$bool = false;
		while(($row = mysql_fetch_assoc($res)) && !$bool){
			if($row['pseudo']==$login && $row['motdepasse']==$pass){
				$bool = true;
			}
		}
		return $bool;
	}
	
	function getType($login, $pass){
		$query = $this->bd->query("select type from Utilisateurs where pseudo='$login' and motdepasse='$pass'");
#		var_dump($query);
		$row = mysql_fetch_assoc($query);//un seul passage
			$res = $row['type'];
		return $res;
	}
	
	function getClasse(){
		$query = $this->bd->query("select classe from Produits");
		while($row = mysql_fetch_assoc($query)){
			$res .= '<option value="'.$row['classe'].'">'.$row['classe'].'</option>';
		}
#		echo "<b>".$res."</b>";
		return $res;
	}
}

?>
