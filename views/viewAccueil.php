<?php $this->_t = 'AC Montreuil Juigné';
	foreach ($joueurs as $joueur) : ?>
<h2><?= $joueur->nom() ?></h2>
<time><?= $joueur->ddn() ?> </time>
<?php endforeach; ?>