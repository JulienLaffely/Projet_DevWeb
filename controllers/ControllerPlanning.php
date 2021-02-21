<?php
	require_once('views/View.php');
	require_once('models/modelPlanning.php');

	class ControllerPlanning
	{
		public function __construct()
		{
					$this->_view = new View('Planning');
					$this->_view->generate();
		}
	}