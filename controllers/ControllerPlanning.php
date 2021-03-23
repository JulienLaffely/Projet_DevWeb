<?php
	require_once('views/View.php');
	require_once('models/modelPlanning.php');

	class ControllerPlanning
	{
		private $_view;
		private $_model ;
		private $_joueurDate;

		public function __construct()
		{	
					$this->_model = new modelPlanning();
					if(isset($_POST['modifabs']))$this->_model->ActualisationBDD();
					$this->_view = new View('Planning');
					$this->_view->generate();
					$this->Affiche();
		}

		public function Affiche() {
			$dateActuel="2021-08-01";
			if(isset($_POST['modifabs'])){
				$dateActuel=$_POST['calendrier'];
			}
			$abs=fopen('abscents.json','w+');
			fwrite($abs,json_encode($this->_model->GetAllAbs()));
			fclose($abs);
			?>
			<form method="post">
			<input type='date' id='calendrier' name='calendrier' min='2021-08-01' max='2022-07-31' value='<?php echo $dateActuel ;?>' onchange="dateP()">
       		<?php
			echo "</br></br></br>";
			echo "<table id='tablep'>";
			echo "<tr id='trp'>
						<td id='tdp'><b>NOM</b></td>
						<td id='tdp'><b>PRENOM</b></td>
						<td id='tdp'><b>RAISON ABSCENCE</b></td>
				  </tr>";
			foreach ($this->_model->Joueurs() as $joueur) {
				echo "<tr  id='trp'>
						<td id='tdp'>$joueur[1]</td>
						<td id='tdp'>$joueur[2]</td>
						<td id='tdp'>
							<select class='selector' id='$joueur[0]' name='$joueur[0]'>
								<option value='present'></option>
								<option value='ABS'>Abscent</option>
								<option value='BLE'>Blesser</option>
								<option value='NL'>Non-Licencié</option>
								<option value='SUS'>Suspendu </option>
							</select>
						</td>
					  </tr>";

				$this->_joueurDate=$this->_model->GetAbsJoueur($joueur[0],$dateActuel);
				if($this->_joueurDate!=null){
					foreach ($this->_joueurDate as $ligne ) {
						echo "<script>actualisationSelect($joueur[0],\"$ligne[1]\");</script>";	
					}

				}
			}
			echo "</table></br>
			<input type='submit' value='Enregistrer les modifictions' id='modifabs' name='modifabs'/></form>
			</div></body></html>";
		}
	}