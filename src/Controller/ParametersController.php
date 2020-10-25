<?php
	namespace App\Controller;

	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Datasource\ConnectionManager;
	use Cake\ORM\TableRegistry;

	class ParametersController extends AppController
	{
		public function beforeFilter(Event $event)
		{
				$this->set('topBarTitle', 'Paramètres');
				$this->set('navActive','parameters');
				$this->set('subNav',$this->request->getParam('action'));
		}

		public function general()
		{
			$this->set('title','Paramètres - Général');
			$this->loadComponent('Custom');
			

			$applyTvaText = $this->Parameters->find()->where(['label' => 'applyTvaText'])->first();

			$params = $this->Custom->getAllParams(false);
			$this->set(compact('params','applyTvaText'));

			if($data = $this->request->getData())
			{
				foreach ($data['select'] as $key => $value) 
				{
					if($params[$key][0] != $data['select'][$key])
					{
						$oldParam = $this->Parameters->find()->where(['id' => $params[$key][0]])->first();
						$this->Parameters->patchEntity($oldParam, ['bool' => false]);
						$this->Parameters->save($oldParam);

						$newParam = $this->Parameters->find()->where(['id' => $data['select'][$key]])->first();
						$this->Parameters->patchEntity($newParam, ['bool' => true]);
						$this->Parameters->save($newParam);
					}
				}

				$conn = null;

				if($params['applyTva'] != $data['applyTva'])
				{
					$conn = ConnectionManager::get('default');
					$res = $conn->query('UPDATE parameters SET bool='.intval($data['applyTva']).' WHERE label = "applyTva"');
				}

				if($applyTvaText['parameter'] != $data['applyTvaText'])
				{
					$conn = (is_null($conn))?ConnectionManager::get('default'):$conn;
					$res = $conn->query('UPDATE parameters SET parameter ="'.$data['applyTvaText'].'" WHERE id ='.$applyTvaText['id']);
				}
				return $this->redirect($this->referer());
			}
		}

		public function deleteParam($id,$param)
		{
			$conn = ConnectionManager::get('default');
			if($res = $conn->query('DELETE FROM parameters WHERE id ='.$id))
				return $this->redirect(['action' => 'edit-param',$param]);
		}

		public function editParam($param)
		{
			$this->set('subNav','general');
			$params = $this->Parameters->find('all')->where(['label' => $param])->order(['parameter' => 'ASC']);
			$this->set(compact('params'));

			switch ($param) {
				case 'articleType':
					$titleParam = "Ajouter/supprimer un type d'article";
					break;
				case 'payCondition':
					$titleParam = "Ajouter/supprimer une condition de paiement";
					break;
				case 'payType':
					$titleParam = "Ajouter/supprimer un mode de règlement";
					break;
				case 'payInterest':
					$titleParam = "Ajouter/supprimer un intérêt de retard";	
					break;			
				default:
					$this->redirect(['action' => 'general']);
			}
			$this->set(compact('titleParam'));

			if($data = $this->request->data())
			{
				$new = $this->Parameters->newEntity();
				$this->Parameters->patchEntity($new,['label' => $param, 'parameter' => $data['newParam']]);
				if($this->Parameters->save($new))
					return $this->redirect($this->referer());
			}
		}

		public function numerotation()
		{
			$this->set('title','Paramètres - Numérotation');
			$format = $this->Parameters->find()->where(['label' => 'formatNumerotation'])->first();
			$size = $this->Parameters->find()->where(['label' => 'tailleCompteur'])->first();
			$devis = $this->Parameters->find()->where(['label' => 'devisLabel'])->first();
			$factures = $this->Parameters->find()->where(['label' => 'facturesLabel'])->first();
			$avoirs = $this->Parameters->find()->where(['label' => 'avoirsLabel'])->first();
			$acomptes = $this->Parameters->find()->where(['label' => 'acomptesLabel'])->first();
			$this->set(compact('format','size','devis','factures','avoirs','acomptes'));

			if($data = $this->request->getData())
			{
				if(isset($data['devis']))
				{
					$this->Parameters->patchEntity($devis,['parameter' => $data['devis']]);
					$this->Parameters->save($devis);
					$this->Parameters->patchEntity($factures,['parameter' => $data['factures']]);
					$this->Parameters->save($factures);
					$this->Parameters->patchEntity($avoirs,['parameter' => $data['avoirs']]);
					$this->Parameters->save($avoirs);
					$this->Parameters->patchEntity($acomptes,['parameter' => $data['acomptes']]);
					$this->Parameters->save($acomptes);
				}
				else
				{
					$this->Parameters->patchEntity($format,['parameter' => $data['format']]);
					$this->Parameters->save($format);
					$this->Parameters->patchEntity($size, ['parameter' => $data['size']]);
					$this->Parameters->save($size);
				}
			}
		}

		public function actionsTexts($type)
		{
			$this->set('title','Paramètres - '.$this->Custom->getFormatedType($type));
			$subNav = $type;
			$texts = $this->Parameters->find()->where(['label LIKE' => $type.'Text%'])->order(['id' => 'ASC'])->toArray();
			$this->set(compact('texts','subNav'));

			if($data = $this->request->getData())
			{
				foreach($data as $key => $value)
				{
					$text = $this->Parameters->find()->where(['label' => $type.'Text'.ucfirst($key)])->first();
					$this->Parameters->patchEntity($text,['parameter' => $value]);
					$this->Parameters->save($text);
				}
			}
		}

		public function users()
		{
			$this->set('title',"Paramètres - Coordonnées de l'entreprise");
			$Users = TableRegistry::get('Users');
			$labels = $this->Parameters->find()->where(['label LIKE' => 'user%'])->order(['id' => 'ASC'])->toArray();
			$user = $Users->find()->first();
			$this->set(compact('user','labels'));
			if($data = $this->request->getData())
			{
				foreach($data as $key => $value)
				{
					$label = $this->Parameters->find()->where(['label' => 'user'.ucfirst($key)])->first();
					$this->Parameters->patchEntity($label, ['parameter' => ($value == '')?null:$value]);
					$this->Parameters->save($label);
				}
				return $this->redirect($this->referer());
			}
		}

		public function rib($add = false)
		{
			$this->set('title','Paramètres - Comptes bancaires');
			$this->set(compact('add'));
			$RibsTable = TableRegistry::get('Ribs');

			$ribs = $RibsTable->find('all');
			$this->set(compact('ribs'));

			if($data = $this->request->getData())
			{
				$newRib = $RibsTable->newEntity($data);
				if($RibsTable->save($newRib))
					return $this->redirect(['action' => 'rib']);
			}
		}
	}
?>