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
