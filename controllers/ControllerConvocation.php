<?php
	require_once('views/View.php');
	require_once('models/modelConvocation.php');

	class ControllerConvocation
	{
		public function __construct()
		{
					$this->_view = new View('Convocation');
					$this->_view->generate();
		}
	}