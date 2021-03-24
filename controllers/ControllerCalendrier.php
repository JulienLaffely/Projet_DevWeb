<?php
	require_once('views/View.php');

	class ControllerCalendrier
	{
		public function __construct()
		{
					$this->_view = new View('Calendrier');
					$this->_view->generate();
					$this->AfficheCalendrier();
		}

		public function AfficheCalendrier()
		{
			if(($csv=fopen("matchs.csv","r"))!==FALSE)
			{
				while(($ligne=fgetcsv($csv,1000,";"))!==FALSE)
				{
					if($ligne[0]=="COMPETITION")
					{		
						echo "<table id='tablec'>
							  <tr>
							  	<td id='tdc'><b>$ligne[0]</b></td>
							  	<td id='tdc'><b>$ligne[1]</b></td>
							  	<td id='tdc'><b>$ligne[2]</b></td>
							  	<td id='tdc'><b>$ligne[3]</b></td>
							  	<td id='tdc'><b>$ligne[4]</b></td>
							  	<td id='tdc'><b>$ligne[5]</b></td>
							  	<td id='tdc'><b>$ligne[6]</b></td>
							  </tr>";
					}
					else
					{
						$date=str_replace("/", "-", $ligne[3]);
						$date=explode("-", $date);
						$aux=$date[0];
						$date[0]=$date[2];
						$date[2]=$aux;
						$date=implode("-", $date);
						echo "
							<tr>
								<td id='tdc'>
									<select name='competition' style='opacity:0.9;'>
										<option value='CD'>Coupe Départementale</option>
										<option value='CI'>Coupe Intercomunale</option>
										<option value='Ch'>Championnat départementale</option>
										<option value='A'>Amical</option>
									</select>
								</td>
								<td id='tdc'>
									<select name='equipe' style='opacity:0.9;'>
										<option value='S1'>SENIORS_1</option> 
										<option value='S2'>SENIORS_2</option> 
										<option value='S3'>SENIORS_3</option> 
									</select>
								</td>
								<td id='tdc'>
									<select name='EquipeAdverse' style='opacity:0.9;'>";
									if(($equipA=fopen("Liste_equipes_terrain_site.csv","r"))!==FALSE)
									{
										while(($eq=fgetcsv($equipA,1000,";"))!==FALSE)
										{
											if($eq[0]!="Equipes")
											{
												echo "<option value='$eq[0]'>$eq[0]</option>";
											}
										}
										fclose($equipA);
									}
									echo "
									</select>
								</td>
								<td id='tdc'>
									<input type='date'  min='2021-08-01' max='2022-07-31' value='$date' style='opacity:0.9;'/>
								</td>
								<td id='tdc'>
									<input name='heure' type='time' min='08:00' max='20:00' value='$ligne[4]' style='opacity:0.9;' />
								</td>
								<td id='tdc'>
									<select name='terrain' style='opacity:0.9;'>";
									if(($terrain=fopen("Liste_equipes_terrain_site.csv","r"))!==FALSE)
									{
										while(($ter=fgetcsv($terrain,1000,";"))!==FALSE)
										{
											if($ter[2]!="Terrain")
											{
												echo "<option value='$ter[2]'>$ter[2]</option>";
											}
										}
										fclose($terrain);
									}
									echo "
									</select>
								</td>
								<td id='tdc'>
									<select name='site' style='opacity:0.9;'>";
									if(($site=fopen("Liste_equipes_terrain_site.csv","r"))!==FALSE)
									{
										while(($si=fgetcsv($site,1000,";"))!==FALSE)
										{
											if($si[1]!="Site")
											{
												echo "<option value='$si[1]'>$si[1]</option>";
											}
										}
										fclose($site);
									}
									echo "
									</select>
								</td>

						";
					}
				}
				fclose($csv);
			}
			
		}
	}
?>