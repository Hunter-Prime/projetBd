<!-- dans la variable de session logged, indique si le connecté est client ou administrateur-->
<?php session_start();
#unset($_SESSION['connexion']);

#var_dump($_SESSION['connexion']);
$choice = 'style="display: none;"';
$noChoice = '';
if(!isset($_SESSION['systeme'])){
	$choice = '';
	$noChoice = 'style="display: none;"';
}
if(!isset($_SESSION['connexion'])){
		$_SESSION['connexion'] = false;
}

if($_SESSION['connexion']){
	$forConnect = '';
	$forNotConnect = 'style="display: none;"';
} else {
	$forConnect = 'style="display: none;"';
	$forNotConnect = '';
	$_SESSION['logged'] = 'visiteur';
}
if($_SESSION['logged']=='admin'){
	$style = '';
} else {
	$style = 'style="display: none;"';
}


//sur windows enlever /private
  //echo strrchr($_SERVER['SCRIPT_FILENAME'], "/")."<br/>";
  
function GetBasePath($param = null) {
	if(!isset($param)){
    	return substr($_SERVER['SCRIPT_FILENAME'], 0, strlen($_SERVER['SCRIPT_FILENAME']) - strlen(strrchr($_SERVER['SCRIPT_FILENAME'], "/")));
    } else {
    	return substr($param, 0, strlen($param) - strlen(strrchr($param, "/")));
    }
} 



$_SESSION['chemin'] = GetBasePath(GetBasePath());
include_once($_SESSION['chemin']."/metier/Systeme.class.php");

?>
<html>
	<head>
		<title>projet base de données</title>
		<link rel="stylesheet" href="../script/jquery-ui/css/ui-lightness/jquery-ui-1.8.11.custom.css" type="text/css"/>
		<link rel="stylesheet" href="./css/style.css"/>
		<script type="text/javascript" src="../script/jquery-ui/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="../script/jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
		<script type="text/javascript" src="../script/jquery-ui/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="../script/XMLHttpRequest.js"></script>
		<script type="text/javascript" src="../script/connexion.js"></script>
		<script type="text/javascript" src="../script/location.js"></script>
		<script type="text/javascript" src="../script/initObjectJQuery.js"></script>
	</head>
	
	<body>
		<div id="location" <?php echo $choice;?>><button id="CIE" name="location" onclick="setLocation(this)">CIE</button><button id="home" name="location" onclick="setLocation(this)">chez toi</button></div>
		<div id="connect" class="body" <?php if($choice == ''){
														echo $noChoice;
													} elseif($_SESSION['connexion']) {
														echo $forConnect;
													} else {
														echo $forNotConnect;
													}?>> <?php 
													if($_SESSION['connexion']){
																	echo $_SESSION['user'];
																} else {
																	echo "visiteur";
																}
													?> </div>
		<div id="authentification" class="body" <?if($choice == ''){
														echo $noChoice;
													} else {
														echo $forNotConnect;
													}?>>
			<label for="user"> utilisateur </label> <input type="text" id="user" name="utilisateur"/><br/>
			<label for="mdp"> mot de passe </label> <input type="password" id="mdp" name="motdepasse"/><br/>
			<button type="button" onclick=connexion();> connexion </button><br/>
		</div>
		<div id="listBd" <?php echo $style;?>><a href="#"> liste des tables de la base de données</a></div>
		
		<div id="menuBar" class="body" <?php echo $noChoice;?>>
			<ul>
				<li><a href="#presentation">Présentation</a></li>
				<li><a href="#recherche">Recherche</a></li>
				<li><a href="#panier">Mon Panier</a></li>
				<li><a href="#commande">Ma Commande</a></li>
			</ul>
			<div id="presentation">
				<p>page de présentation</p>
			</div>
			<div id="recherche">
				<?php include_once("./include/recherche.php.inc");?>
			</div>
			<div id="panier">
				<p>le panier</p>
			</div>
			<div id="commande">
				<p>commande</p>
			</div>
		</div>
		
	</body>
</html>
