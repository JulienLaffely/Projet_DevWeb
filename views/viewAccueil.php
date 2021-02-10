<?php $this->_t = 'Mon test';
	foreach ($joueurs as $joueur) : ?>
<h2><?= $joueur->nom() ?></h2>
<time><?= $joueur->ddn() ?> </time>
<?php endforeach; ?>