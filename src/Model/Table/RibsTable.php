<?php
	namespace App\Model\Table;

	use Cake\ORM\Table;

	class RibsTable extends Table
	{
		public function initialize(array $config)
		{
			$this->setTable('ribs');
		}
	}
?>