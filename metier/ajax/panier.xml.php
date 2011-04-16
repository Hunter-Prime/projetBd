<?php session_start();
	header("Content-Type: text/xml");
	include_once($_SESSION['chemin']."/metier/Systeme.class.php");
	$systeme = unserialize($_SESSION['systeme']);
	$indice = $_GET['indice'];
	
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	echo "<list>";
	echo "<item nomproduit=\"".$_SESSION['recherche'][$indice]['nomproduit']."\"/>\n";
	echo "</list>";
	$i = count($_SESSION['panier']);
	$_SESSION['panier'][$i]['nomproduit'] = $_SESSION['recherche'][$indice]['nomproduit'];
	$_SESSION['panier'][$i]['qterestante'] = $_SESSION['recherche'][$indice]['qterestante'];
	$_SESSION['panier'][$i]['prix'] = $_SESSION['recherche'][$indice]['prix'];
?>
