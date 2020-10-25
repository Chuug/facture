<?php
    namespace App\Model\Table;

    use Cake\ORM\Table;

    class ActionsTable extends Table
    {
        public function initialize(array $config)
        {
        	$this->setTable('actions');
        	$this->hasOne('Clients',['foreignKey' => 'id','bindingKey' => 'client_id']);
        	$this->hasOne('Compagnies',['foreignKey' => 'id', 'bindingKey' => 'compagnie_id']);
            $this->hasOne('Origin', ['className' => 'Actions', 'foreignKey' => 'id', 'bindingKey' => 'origin_id']);
            $this->hasMany('Articles', ['dependent' => true])->setForeignKey('action_id');
            $this->hasMany('Links',['className' => 'Actions','foreignKey' => 'link_id','bindingKey' => 'link_id']);
            $this->hasOne('Ribs',['foreignKey' => 'id', 'bindingKey' => 'rib_id']);
        }
    }
?>
