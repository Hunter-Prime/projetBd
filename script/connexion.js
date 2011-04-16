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
				textNode = document.createTextNode("" + ident);
				if(type == "administrateur")
					document.getElementById("listBd").style.display = "block";
				connect.appendChild(textNode);
			}
