<?php
	require_once('views/View.php');
	require_once('models/modelAccueil.php');

	class ControllerAccueil
	{
		private $_view;
		private $_model;

		public function __construct()
		{
				$this->_model = new modelAccueil();
				$this->_view = new View('Accueil');
				$this->_view->generate();
				$this->AfficherConvocations();
		}

		public function alerteconnexion(){
			echo "<script type='text/javascript'>alert('Veuillez remplir les deux champs !');</script>";
		}

		public function AfficherConvocations()
		{
			$Convocations=$this->_model->GetConvocations();
			echo "</br></br><form>";
			foreach ($Convocations as $convocation) {
				$date=$convocation['date'];
				$equipe=$convocation['equipe'];
				$adversaire= $convocation['adversaire'];
				$terrain=$convocation['terrain'];
				$site=$convocation['site'];
				$competition=$convocation['competition'];
				$heure=substr($convocation['heure'],0,-3);
				$joueurs=explode(";", $convocation['joueurs']);
				unset($joueurs[sizeof($joueurs)-1]);
				echo "<fieldset id='accueil2'>
						<legend>$date</legend>
						<label>Match :     </label><input type='text' value='$equipe VS $adversaire' style='width:200px;border:none;background-color:rgba(0, 0, 0, 0);color:#FFFFFF;' disabled/>
						<label style='margin-left:50px'>Lieu :      </label><input type='text' value='$terrain à $site' style='width:200px;border:none;background-color:rgba(0, 0, 0, 0);color:#FFFFFF;' disabled/>
						<label style='margin-left:50px'>Competition :      </label><input type='text' value='$competition' style='width:200px;border:none;background-color:rgba(0, 0, 0, 0);color:#FFFFFF;' disabled/>
						<label style='margin-left:50px'>Heure :      </label><input type='text' value='$heure' style='width:100px;border:none;background-color:rgba(0, 0, 0, 0);color:#FFFFFF' disabled/></br></br>
						<center><label><b>Joueurs Convoqués</b></label></center>
						<table id='tbAccueil'><tr>
							";
							for($i=0;$i<14;++$i)
							{
								if(array_key_exists($i,$joueurs))echo "<td id='tdacceuil'>$joueurs[$i]</td>";
								else echo "<td id='tdacceuil'></td>";
								if($i==6)echo "</tr><tr>";
							}
							echo "
						</tr></table>
					  </fieldset>
					  </br>
					  </br>
					";
			}
		}

	}	

?>