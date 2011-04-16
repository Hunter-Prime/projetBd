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
		$row = mysql_fetch_assoc($query);//un seul passage
			$res = $row['type'];
		return $res;
	}
	
	function getClasse(){
		$query = $this->bd->query("select classe from Produits");
		while($row = mysql_fetch_assoc($query)){
			$res .= '<option value="'.$row['classe'].'">'.$row['classe'].'</option>';
		}
		return $res;
	}
	
	function recherche($pattern, $classe){
		$text = "select nomproduit, prix, qterestante from Produits";
		if($classe != '' && $pattern != ''){
			$text .= " where classe='$classe' and nomproduit like '%$pattern%'";
		} elseif($classe != ''){
			$text .= " where classe='$classe'";
		} elseif($pattern != ''){
			$text .= " where nomproduit	like '%$pattern%'";
		}
		$query = $this->bd->query($text);
#		var_dump($query);
		$res = '<table>
					<tr>
						<th>nom du produit</th><th>quantie restante</th><th>prix</th>
					</tr>'
					;
		$cpt = 0;
		while($row = mysql_fetch_assoc($query)){
			$res .= '<tr><td>'.$row['nomproduit'].'</td><td>'.$row['qterestante'].'</td><td>'.$row['prix'].'</td><td><span id="'.$cpt.'" class="imgPanier" onclick=ajouterPanier(this.id);><img src="./images/panier.jpg" alt="ajouter au panier"/></span></td></tr>';
			$_SESSION['recherche'][] = array("nomproduit" => $row['nomproduit'],
											 "qterestante" => $row['qterestante'],
											 "prix" => $row['prix']);
			$cpt++;
		}
		$res .= '</table>';
#		var_dump($res);
		return $res;
	}
}

?>
