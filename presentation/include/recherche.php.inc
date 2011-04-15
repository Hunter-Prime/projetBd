			<form action="" method="POST">
				<div id="rechercheMot">
					recherche<br/>
					<?php
						echo '<input type="text" name="parMot" value="'.$_POST['parMot'].'"/>';
					?>
				</div>
				<div id="rechercheClasse">
					<select id="selectClasse" name="selectClasse">
						<option value=''>recherche globale</option>
					<?php
						$sys = unserialize($_SESSION['systeme']);
#						var_dump($sys);
						echo $sys->getClasse();
					?>
					</select>
				</div>
				<div id="traitForm">
					<input type="submit" value="envoyer"/>
					<input type="reset" value="raz"/>
				</div>
			</form>
			<?php 
				if(!isset($_POST['parMot'])){
					$_POST['parMot'] = '';
				}
				echo $sys->recherche($_POST['parMot'], $_POST['selectClasse']);
			?>
