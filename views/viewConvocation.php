<?php $this->_t = 'Convocations'; ?>
<center>
<form id="bouttons4" method="post">
<input id="test" type="submit" name="onglet" value="Calendrier" />
<input type="submit" name="onglet" value="Planning Absences" />
<input type="submit" name="onglet" value="Convocation" disabled/>
<input type="submit" name="onglet" value="Effectif"/>
<input type="submit" name="onglet" value="Accueil" />
</form>
</center>
</br>
<input type="date" id="calendrier" 
       min="2021-08-01" max="2022-07-31" value="2021-08-01" onchange="dateCon()">

