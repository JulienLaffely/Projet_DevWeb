<?php
	require_once('views/View.php');
	require_once('models/modelEffectif.php');

	class ControllerEffectif
	{
		public $_view;
		public $_model ;
		public function __construct()
		{	
					$this->_model = new modelEffectif();
					if(isset($_POST['NewJoueur']))$this->_model->AjoutJoueurBDD();
					$this->_view = new View('Effectif');
					$this->_view->generate();
					$this->AfficheJoueurs();
					$this->AfficheEnregistrementJoueur();
		}

		public function AfficheJoueurs()
		{
			echo "</br></br></br>
					<table id='tableE'>
					<tr>
						<td id='tde'><b>NOM</b></td>
						<td id='tde'><b>PRENOM</b></td>
						<td id='tde'><b>DATE DE NAISSANCE</b></td>
				 	</tr>";
			foreach ($this->_model->getAllJoueurs() as $joueur) {
				echo "	<tr>
							<td id='tde'>$joueur[0]</td>
							<td id='tde'>$joueur[1]</td>
							<td id='tde'>$joueur[2]</td>
						</tr>";

			}
			echo "</table></br>";
		}

		public function AfficheEnregistrementJoueur()
		{
			echo "<form method='post'>
					<fieldset id='Enregistrement'>
					<legend>Enregistrement de nouveau joueur</legend>
					<label>Nom</label>
					<input type='text' name='NomNewJoueur'/>
					<label style='margin-left: 150px'>Prenom</label>
					<input type='text' name='PrenomNewJoueur'/>
					<label style='margin-left: 140px'>Date de naissance</label>
					<input type='date' min='1950-01-01' max='2002-01-01' name='DdnNewJoueur'/>
					</br></br>
					<input type='submit' name='NewJoueur' id='BoutAjoutJoueur' value='Enregistrer un nouveau joueur' style='margin-left: 370px;height:50px;background-color:green'/>
					</fieldset>
				</form>";
		}
	}
?>