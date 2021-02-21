<?php
	require_once('views/View.php');
	require_once('models/modelCalendrier.php');

	class ControllerCalendrier
	{
		public function __construct()
		{
					$this->_view = new View('Calendrier');
					$this->_view->generate();
		}
	}