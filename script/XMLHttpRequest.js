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
