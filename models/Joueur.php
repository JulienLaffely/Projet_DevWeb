<?php
	class Joueur
	{
		private $_id;
		private $_nom;
		private $_prenom;
		private $_ddn ;


		// constructeur
		public function __construct(array $data)
		{
			$this->hydrate($data);
		}

		// hydratation
		public function hydrate(array $data)
		{
			foreach($data as $key => $value)
			{
				$method = 'set'.ucfirst($key);

				if(method_exists($this, $method))
					$this->$method($value);
			}
		}

		//Setters
		public function setId($id)
		{
			$id = (int) $id ;

			if($id > 0)
				$this->_id = $id;
		}

		public  function setNom($nom)
		{
			if(is_string($nom))
				$this->_nom=$nom;
		}

		public  function setPrenom($prenom)
		{
			if(is_string($prenom))
				$this->_prenom=$prenom;
		}

		public  function setDdn($date)
		{
			$this->_ddn=$date ;
		}

		// Getters

		public function id()
		{
			return $this->_id;
		}

		public function nom()
		{
			return $this->_nom;
		}

		public function prenom()
		{
			return $this->_prenom;
		}

		public function ddn()
		{
			return $this->_ddn;
		}
	}
?>