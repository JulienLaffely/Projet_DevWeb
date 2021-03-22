<?php
	require_once('views/View.php');
	require_once('models/modelPlanning.php');

	class ControllerPlanning
	{
		public $_view;
		public $_model ;
		public $_joueurDate;

		public function __construct()
		{	
					$this->_model = new modelPlanning();
					$this->_view = new View('Planning');
					$this->_view->generate();
					$this->Affiche();
		}

		public function Affiche() {
			$dateActuel="2021-08-01";
			if(isset($_POST['modifabs'])){
				$dateActuel=$_POST['calendrier'];
			}
			?>

			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type='date' id='calendrier' name='calendrier' min='2021-08-01' max='2022-07-31' value='<?php echo $dateActuel ;?>' onchange="<?php $abs=fopen('abscents.json','w+');fwrite($abs,json_encode($this->_model->GetAllAbs()));fclose($abs);?> dateP()">
       		<?php
			echo "</br></br></br>";
			echo "<table>";
			echo "<tr>
						<td><b>NOM</b></td>
						<td><b>PRENOM</b></td>
						<td><b>RAISON ABSCENCE</b></td>
				  </tr>";
			foreach ($this->_model->_joueurs as $joueur) {
				echo "<tr>
						<td>$joueur[1]</td>
						<td>$joueur[2]</td>
						<td>
							<select class='selector' id='$joueur[0]'>
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