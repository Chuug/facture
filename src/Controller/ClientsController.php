<?php
	namespace App\Controller;

	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\ORM\TableRegistry;

	class ClientsController extends AppController
	{
		public function beforeFilter(Event $event)
		{
			$this->set('navActive','clients');
		}

		public function index()
		{
			$this->set('title','Clients');
			$clients = $this->Clients->find('all')->contain(['Coordonnees' => function($q){return $q->select(['telephone']);},'Compagnies' => function($q){return $q->select(['id','nom_societe']);}])->select(['nom','prenom','id','mail'])->where(['clients.is_deleted IS FALSE']);

			$count = $clients->count();

			$topBarTitle = 'Clients ('.$count.')';

			$this->set(compact('count','clients','topBarTitle'));			
		}

		public function view($id)
		{
			
			$client = $this->Clients->find('all')->contain(['Coordonnees','Compagnies' => ['Coordonnees']])->where(['Clients.id' => $id])->first();
			$actions = $this->Clients->Actions->find()->where(['client_id' => $id])->contain(['Clients' => ['Compagnies'],'Compagnies'])->order(['actions.ts_created' => 'DESC']);

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

			$this->set(compact('devisCount','facturesCount','acomptesCount','avoirsCount'));

			$topBarTitle = $client->nom.' '.$client->prenom.((!is_null($client->compagny))?' de <a href="/compagnies/fiche/'.$client->compagny->id.'" class="text-white">'.$client->compagny->nom_societe.'</a>':'');

			$this->set('title','Client '.$client->nom.' '.$client->prenom);

			$this->set(compact('client','topBarTitle','actions'));
		}

		public function add($id = null)
		{
			$this->set('topBarTitle', 'Ajouter un client');
			$this->set('title','Ajouter un client');
			$this->set(compact('id'));
			if($this->request->getData())
			{
				$type = $this->request->data['type'];
				$this->request->data['compagnie_id'] = ($type == 0)?null:$this->request->data['compagnie_id'];

				$new = $this->Clients->newEntity($this->request->getData(),['associated' => ['Coordonnees']]);
				$this->Clients->patchEntity($new,['ts_created' => $this->Custom->getTs()]);
				if($this->Clients->save($new))
				{
					if($type == 0)
					{
						return $this->redirect(['action' => 'view',$new->id]);
					}
					elseif($type == 1)
					{
						if(!is_null($new->compagnie_id))
							return $this->redirect(['action' => 'view',$new->id]);
						else
							return $this->redirect(['controller' => 'Compagnies', 'action' => 'add',$new->id]);
					}
					else
					{
						//erreur
					}					
				}
			}
		}

		public function edit($id)
		{
			$client = $this->Clients->find()->where(['clients.id' => $id])->contain(['Coordonnees','Compagnies'])->first();
			$this->set('topBarTitle','Modifier '.$client->nom.' '.$client->prenom);
			$this->set('title','Modifier '.$client->nom.' '.$client->prenom);
			$this->set(compact('client'));
			if($this->request->getData())
			{
				$this->Clients->patchEntity($client,$this->request->getData(), ['associated' => ['Coordonnees','Compagnies']]);
				if($this->Clients->save($client))
					return $this->redirect(['action' => 'view',$client->id]);
			}
		}

		public function delete($id)
		{
			$client = $this->Clients->get($id);
			$this->Clients->patchEntity($client,['is_deleted' => true]);
			if($this->Clients->save($client))
			{
				$this->Custom->flash('Le client a été supprimé',3000,'success');
				return $this->redirect(['action' => 'index']);
			}
		}
	}
?>