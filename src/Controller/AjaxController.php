<?php
	namespace App\Controller;

	use App\Controller\AppController;
	use Cake\ORM\TableRegistry;
	use Cake\Datasource\ConnectionManager;

	class AjaxController extends AppController
	{
		#############################
		#### C O M P A G N I E S ####
		#############################




		#############################
		#### P A R A M E T E R S ####
		#############################

		public function getArticlesParams()
		{
			$conn = ConnectionManager::get('default');
			$req = $conn->query('SELECT parameter,bool FROM parameters WHERE label = "articleType" ORDER BY parameter ASC');
			$i = 0;
			foreach ($req as $type) 
			{
				$types[$i][0] = $type['parameter'];
				$types[$i][1] = $type['bool'];
				$i++;
			}

			$req = $conn->query("SELECT parameter,bool FROM parameters WHERE label = 'tva'");
			$i = 0;
			foreach($req as $tva)
			{
				$tvas[$i][0] = $tva['parameter'];
				$tvas[$i][1] = $tva['bool'];
				$i++;
			}
			$this->set(compact('types','tvas'));
		}

		public function getTvaDefault()
		{
			$ParametersTable = TableRegistry::get('Parameters');
			$tva = $ParametersTable->find()->where(['label' => 'tva'])->andWhere(['bool IS TRUE'])->first();
			$this->set('tva',$tva->parameter);
		}
	}
?>