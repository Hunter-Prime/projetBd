			<form action="" method="POST">
				<div id="rechercheMot">
					<?php
					if(!isset($_POST['parMot'])){
						echo 'recherche par mots<input type="text" name="parMot"/>';
					} else {
						echo 'recherche par mots<input type="text" name="parMot" value="'.$_POST['parMot'].'"/>';
					}
					?>
				</div>
				<div id="rechercheClasse">
					recherche par classe : 
					<select id="selectClasse">
					<?php
						$sys = unserialize($_SESSION['systeme']);
						var_dump($sys);
						echo $sys->getClasse();
					?>
					</select>
				</div>
				<div id="traitForm">
					<input type="submit" value="envoyer"/>
					<input type="reset" value="raz"/>
				</div>
			</form>
