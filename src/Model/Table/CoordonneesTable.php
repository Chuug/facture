<?php
	namespace App\Model\Table;

	use Cake\ORM\Table;

	class CoordonneesTable extends Table
	{
		public function initialize(array $config)
		{
			$this->setTable('coordonnees');
		}
	}
?>