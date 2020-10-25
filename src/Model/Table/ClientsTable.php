<?php
	namespace App\Model\Table;

	use Cake\ORM\Table;
	use Cake\Event\Event;

	class ClientsTable extends Table
	{
		public function initialize(array $config)
		{
			$this->setTable("clients");
			$this->hasOne("Coordonnees", ['foreignKey' => 'client_id','bindingKey' => 'id']);
			$this->belongsTo("Compagnies", ['foreignKey' => 'compagnie_id']);
			$this->hasMany('Actions');
			//$this->hasMany('Activities');
		}

		public function afterSave(Event $event)
		{
		
		}
	}
?>