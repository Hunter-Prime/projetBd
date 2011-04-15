<!-- dans la variable de session logged, indique si le connecté est client ou administrateur-->
<?php session_start();
#unset($_SESSION['connexion']);
if(!isset($_SESSION['connexion'])){
	$_SESSION['connexion'] = false;
	$_SESSION['logged'] = 'visiteur';
}
var_dump($_SESSION['connexion']);
if($_SESSION['connexion']){
	$forConnect = '';
	$forNotConnect = 'style="display: none;"';
} else {
	$forConnect = 'style="display: none;"';
	$forNotConnect = '';
}
$choice = '';
$noChoice = 'style="display: none;"';
if(isset($_SESSION['systeme'])){
	$choice = 'style="display: none;"';
	$noChoice = '';
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
		<script type="text/javascript" src="../script/jquery-ui/js/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="../script/jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>
		<script type="text/javascript">
			function getXMLHttpRequest() {
				var xhr = null;
				if(xhr && xhr.readyState != 0){
					alert("requete en cours, patientez!");
					return;
				}
				if (window.XMLHttpRequest || window.ActiveXObject) {
					if (window.ActiveXObject) {//...pour internet explorer...
						try {
							xhr = new ActiveXObject("Msxml2.XMLHTTP");
						} catch(e) {
							xhr = new ActiveXObject("Microsoft.XMLHTTP");
						}
					} else {//...pour firefox
						xhr = new XMLHttpRequest(); 
					}
				} else {
					alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
					return null;
				}
				return xhr;
			}
		
			function connexion(){
				var xhr = getXMLHttpRequest();
				var login = document.getElementById("user").value;
				var password = document.getElementById("mdp").value;
				xhr.open("GET", '../metier/ajax/connexion.xml.php?login='+login+'&password='+password, false);
				xhr.send(null);
				var data = xhr.responseXML;
				var user, connect, textNode, type, ident;
				
				user = data.getElementsByTagName("item");
				ident = user[0].getAttribute("user");
				type = user[0].getAttribute("type");
				document.getElementById("authentification").style.display = "none";
				connect = document.getElementById("connect");
				connect.innerHTML = "";
				//faire en sorte que le rechargement de la page laisse afficher la ligne suivante
				textNode = document.createTextNode("bonjour " + ident +", vous etes connecté, en tant que " + type);
				if(type == "administrateur")
					document.getElementById("listBd").style.display = "block";
					document.getElementById("corpRecherche").style.display = "block";
				connect.appendChild(textNode);
			}

			function setLocation(element){
				var xhr = getXMLHttpRequest();
				xhr.open("GET", '../metier/ajax/setLocation.php?id=' + element.id, false);
				xhr.send(null);
				document.getElementById("location").style.display="none";
				var body = document.getElementsByClassName("body");
				for(i = 0; i<body.length; i++){
					body[i].style.display = "block";
				}
			}
			
			$(function() {
				$("#menuBar").tabs();
			});
		</script>
	</head>
	
	<body>
		<div id="location" <?php echo $choice;?>><button id="CIE" name="location" onclick="setLocation(this)">CIE</button><button id="home" name="location" onclick="setLocation(this)">chez toi</button></div>
		<div id="connect" class="body" <?php echo $forNotConnect;?>> vous n'etes pas connecté </div>
		<div id="authentification" class="body" <?php echo $forNotConnect;?>>
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
