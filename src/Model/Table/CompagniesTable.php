<?php
	namespace App\Model\Table;

	use Cake\ORM\Table;

	class CompagniesTable extends Table
	{
		public function initialize(array $config)
		{
			$this->setTable('compagnies');
			$this->hasOne('Coordonnees',['foreignKey' => 'compagnie_id']);
			$this->hasMany('Clients',['foreignKey' => 'compagnie_id']);
			$this->hasMany('Actions');
		}
	}
?>