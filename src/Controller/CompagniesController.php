<?php
	namespace App\Controller;

	use App\Controller\AppController;

	use Cake\ORM\TableRegistry;
	use Cake\i18n\Time;
	use Cake\Network\Exception\NotFoundException;
	use Cake\Datasource\ConnectionManager;
	use Cake\Event\Event;
	use Cake\Network\Http\Client;

	class CompagniesController extends AppController
	{
		public function beforeFilter(Event $event)
		{
			//Ajouter active sur client en css dans le menu
			$this->set('navActive','compagnies');
		}

		public function index()
		{
			$this->set('title','Sociétés');
			$Compagnies = $this->Compagnies->find('all')->where(['is_deleted IS FALSE'])->contain(['Coordonnees','Clients']);
			$nb = $Compagnies->count();
			$topBarTitle = 'Sociétés ('.$nb.')';
			$this->set(compact('Compagnies','nb','topBarTitle'));
		}

		public function add($id = null)
		{
			$this->set('title','Ajouter une société');
			$this->set('topBarTitle','Ajouter une société');
			$this->set(compact('id'));
			$this->set('Clients',$this->Custom->getSoloClients($id));
			$client = null;
			$ClientsTable = TableRegistry::get('Clients');
			if(!is_null($id))
			{		
				$client = $ClientsTable->find()->where(['id' => $id])->select(['id','nom','prenom','compagnie_id'])->first();
				$this->set(compact('client'));
			}
			if($data = $this->request->getData())
			{
				if(isset($this->request->data['nom_societe']))
				{		
					$new = $this->Compagnies->newEntity($data, ['associated' => 'Coordonnees']);
					$this->Compagnies->patchEntity($new,['ts_created' => $this->Custom->getTs()]);
					if($this->Compagnies->save($new))
					{
						if(!empty($data['clients']))
						{
							foreach($data['clients'] as $clientId)
							{
								$updateClient = $ClientsTable->get($clientId);
								$ClientsTable->patchEntity($updateClient,['compagnie_id' => $new->id]);
								$ClientsTable->save($updateClient);
							}							
						}

						if(is_null($id))
							return $this->redirect(['action' => 'view',$new->id]);
						else
						{
							$ClientsTable->patchEntity($client,['compagnie_id' => $new->id]);
							if($ClientsTable->save($client))
								return $this->redirect(['controller' => 'Clients', 'action' => 'view',$client->id]);
						}
					}
				}
			}
		}

		public function edit($id)
		{
			$compagnie = $this->Compagnies->find('all')->where(['compagnies.id' => $id])->contain(['Coordonnees','Clients'])->first();
			$this->set('title','Modifier '.$compagnie->nom_societe);
			$this->set('topBarTitle','Modifier '.$compagnie->nom_societe);
			$this->set(compact('compagnie'));
			if($this->request->getData())
			{
				$this->Compagnies->patchEntity($compagnie,$this->request->getData(), ['associated' => ['Coordonnees']]);
				if($this->Compagnies->save($compagnie))
					return $this->redirect(['action' => 'view',$compagnie->id]);
			}
		}

		public function view($id)
		{
			$compagnie = $this->Compagnies->find('all')->where(['compagnies.id' => $id])->contain(['Coordonnees','Clients' => ['Coordonnees' => function($q){return $q->select(['telephone']);},'Compagnies']])->first();

			$actions = $this->Compagnies->Actions->find()->where(['actions.compagnie_id' => $id])->contain(['Clients' => ['Compagnies'],'Compagnies'])->order(['actions.ts_created' => 'DESC']);

			$devisCount = 0;
			$facturesCount = 0;
			$acomptesCount = 0;
			$avoirsCount = 0;
			foreach($actions as $action)
			{
				switch ($action->a_type) 
				{
					case 'devis':
						$devisCount++;
						break;
					case 'factures':
						$facturesCount++;
						break;
					case 'acomptes':
						$acomptesCount++;
						break;
					case 'avoirs':
						$avoirsCount++;
						break;
				}
			}

			$this->set(compact('devisCount','facturesCount','acomptesCount','avoirsCount','actions'));

			$this->set('topBarTitle','Société '.$compagnie->nom_societe);
			$this->set('title','Société '.$compagnie->nom_societe);
			$this->set(compact('compagnie'));
		}

		public function delete($id)
		{
			$compagny = $this->Compagnies->find()->where(['compagnies.id' => $id])->contain(['Clients'])->first();
			foreach($compagny->clients as $client)
			{
				$this->Compagnies->Clients->patchEntity($client,['compagnie_id' => null]);
				$this->Compagnies->Clients->save($client);
			}
			$this->Compagnies->patchEntity($compagny,['is_deleted' => true]);
			if($this->Compagnies->save($compagny))
			{
				$this->Custom->flash('La societé a été supprimée',3000,'success');
				return $this->redirect(['action' => 'index']);
			}
		}
	}
?>