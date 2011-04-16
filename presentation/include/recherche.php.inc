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
						if(isset($_SESSION['systeme'])){
							$sys = unserialize($_SESSION['systeme']);
							echo $sys->getClasse();
						}
					?>
					</select>
				</div>
				<input type="submit" value="envoyer"/>
				<input type="reset" value="raz"/>
			</form>
			<?php 
				if(isset($_POST['parMot'])){
					echo $sys->recherche($_POST['parMot'], $_POST['selectClasse']);
				}
				var_dump($_SESSION['recherche']);
			?>
