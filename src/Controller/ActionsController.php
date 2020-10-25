<?php
	namespace App\Controller;

	use App\Controller\AppController;
	use Cake\ORM\TableRegistry;
	use Cake\Event\Event;
	use Cake\I18n\Time;
	use Cake\Mailer\Email;

	class ActionsController extends AppController
	{
		public function beforeFilter(Event $event)
		{
			if(in_array($this->request->getParam('action'), ['index','view','add','edit']))
			{
				$this->set('type',$this->request->getParam('type'));
				$this->set('navActive',$this->request->getParam('type'));
			}
		}

		public function index($type = null,$state = null)
		{
			$this->loadComponent('Custom');
			$actions = $this->Actions->find('all')->contain(['Clients' => function($q){return $q->select(['id','compagnie_id','nom','prenom'])->contain(['Compagnies' => function($q){return $q->select(['id','nom_societe']);}]);}, 'Compagnies', 'Articles'])->where(['a_type' => $type])->order(['actions.ts_created' => 'DESC']);

			if(isset($state))
				$actions = $actions->where(['state' => $state]);
			$n = $actions->count();

			$this->set('subNav',((is_null($state))?-1:$state));
			$this->set('topBarTitle',$this->Custom->getFormatedType($type,true).' ('.$n.')');
			$this->set('title',$this->Custom->getFormatedType($type,true));
			$this->set(compact('actions','n'));
		}


		public function view($type,$id)
		{
			$action = $this->Actions->find()->where(['actions.id' => $id])->contain(['Articles','Links' => ['Clients','Compagnies' => ['Coordonnees']],'Origin','Ribs','Clients' => ['Coordonnees','Compagnies' => ['Coordonnees']],'Compagnies' => ['Coordonnees']])->first();
			$this->set('devisId',null);
			$solde = true;
			if($action->acomptes)
			{
				foreach($action->links as $link)
				{
					if($link->a_type == 'acomptes' && $link->state != 5)
					{
						$solde = false;
						break;
					}
				}
			}
			else
				$solde = false;

			//Afficher custom devis ID sur acomptes view
			if(isset($action->links))
			{
				foreach($action->links as $link)
				{
					if($link['a_type'] == 'devis')
						$this->set('devisId',$link['custom_id']);
				}				
			}
			else
				$this->set('devisId',null);

			$reductions = false;
			$colspan = 5;
			foreach($action['articles'] as $article)
			{
				if(!is_null($article['reduction']))
				{
					$reductions = true;
					$colspan = 6;
					break;
				}
			}
			$this->set(compact('reductions','colspan'));

			if($action->solde)
			{
				$acomptes = $this->Actions->find()->where(['link_id' => $action->link_id, 'a_type' => 'acomptes']);
				$this->set(compact('acomptes'));
			}
			$this->set(compact('solde'));

			switch ($action->state) {
				case 1:
					$topBarTitle = $action['formated_type'].' provisoire';
					break;
				default:
					$topBarTitle = $action['formated_type'].' '.$action['custom_id'];
					break;
			}
			$this->set('title',$topBarTitle);
			$this->set([
				'action' => $action,
				'topBarTitle' => $topBarTitle
			]);
		}

		public function add($type,$id = false)
		{
			$this->loadComponent('Custom');
			$new = (($type == 'avoirs')?'Nouvel':(($type == 'factures' || $type == 'acomptes')?'Nouvelle':'Nouveau'));
			$this->set('topBarTitle', $new.' '.strtolower($this->Custom->getFormatedType($type)));
			$this->set('title',$new.' '.strtolower($this->Custom->getFormatedType($type)));
			if($type == 'acomptes')
				$this->set(compact('id'));
			else
				$this->set('id',explode('-', $id));

			$Parameters = TableRegistry::get('Parameters');
			$texts = $Parameters->find()->where(['label LIKE' => $type.'Text%'])->order(['id' => 'ASC'])->toArray();
			$this->set(compact('texts'));


			if($type != 'acomptes')
			{
				$destinataires_clients = $this->Actions->Clients->find('all')->select(['id','nom','prenom'])->contain(['compagnies' => function($q){return $q->select(['compagnies.nom_societe']);}]);
				$destinataires_compagnies = $this->Actions->Compagnies->find('all')->select(['id','nom_societe']);
				$this->set(compact('destinataires_clients','destinataires_compagnies'));				
			}
			else
			{
				$devis = $this->Actions->find('all')->where(['a_type' => 'devis','state' => '4', 'factures IS NULL'])->contain(['Clients' => ['Compagnies'],'Compagnies']);
				$this->set(compact('devis'));
			}

			if($type == 'acomptes' || $type == 'factures')
			{
				$RibsTable = TableRegistry::get('Ribs');
				$ribs = $RibsTable->find('all');
				$ribsArray['-1'] = '';
				foreach($ribs as $rib)
					$ribsArray[$rib->id] = $rib->libel;
				$this->set(compact('ribsArray'));
			}

			$params = $this->Custom->getAllParams();
			$this->set(compact('params'));

			if($data = $this->request->getData())
			{
				$ts = $this->Custom->getTs();
				if($type != 'acomptes')
				{
					$total_ht = 0;
					foreach($data['articles'] as $article)
						$total_ht += $article['ht_total'];
					
					$destinataire = explode('_', $data['destinataire']);	

					$newActions = $this->Actions->newEntity($data,['associated' => 'Articles']);
					$this->Actions->patchEntity($newActions,[$destinataire[0].'_id' => $destinataire[1],'ts_created' => $ts,'total_ht' => $total_ht, 'a_type' => $type, 'rib_id' => (($type == 'factures' && $data['bank_account'] > 0)?$data['bank_account']:null)]);

					if($destinataire[0] == 'client')
					{
						$client = $this->Actions->Clients->find()->where(['clients.id' => $destinataire[1]])->contain(['Compagnies'])->first();	
						if(isset($client->compagny))
							$this->Actions->patchEntity($newActions,['compagnie_id' => $client->compagny->id]);
					}

					if($this->Actions->save($newActions))
						return $this->redirect(['controller' => 'Files', 'action' => 'pdf',$type,$newActions->id,true]);					
				}
				else
				{

					$devis = $this->Actions->get($data['devis']);
					if(is_null($devis['link_id']))
					{
						$Parameters = TableRegistry::get('Parameters');
						$param = $Parameters->find()->where(['label' => 'linkId'])->first();
						$linkId = $param['parameter'] + 1;
						$Parameters->patchEntity($param,['parameter' => $param['parameter'] + 1]);
						$Parameters->save($param);
						$this->Actions->patchEntity($devis,['link_id' => $linkId]);
					}
					else
						$linkId = $devis['link_id'];
					$this->Actions->patchEntity($devis,['acomptes' => true]);
					if($this->Actions->save($devis))
					{
						$newActions = $this->Actions->newEntity($data);
						$customId = $this->Custom->getCustomId($type);
						$this->Actions->patchEntity($newActions,['a_type' => 'acomptes','ts_created' => $ts, 'link_id' => $linkId, 'total_ht' => $devis['total_ht'], 'total_ttc' => $devis['total_ttc'], 'devise' => $devis['devise'],'remise_generale' => $devis['remise_generale'], 'remise_generale_param' => $devis['remise_generale_param'],'acompte_tva' => $data['acompte_tva'],'rib_id' => ($data['bank_account'] > 0)?$data['bank_account']:null]);
						if(!is_null($devis['client_id']))
						{
							$this->Actions->patchEntity($newActions,['client_id' => $devis['client_id']]);
							$client = $this->Actions->Clients->find()->where(['clients.id' => $devis['client_id']])->contain(['Compagnies'])->first();	
							if(isset($client->compagny))
								$this->Actions->patchEntity($newActions,['compagnie_id' => $client->compagny->id]);
						}
						if(!is_null($devis['compagnie_id']))
							$this->Actions->patchEntity($newActions,['compagnie_id' => $devis['compagnie_id']]);
						if($this->Actions->save($newActions))
							return $this->redirect(['controller' => 'Files', 'action' => 'pdf',$type,$newActions->id,true]);
					}	
				}
			}
		}

		public function edit($type,$id,$new = false)
		{
			$this->loadComponent('Custom');
			$this->set(compact('new','type'));
			$Parameters = TableRegistry::get('Parameters');

			if($new)
			{			
				$texts = $Parameters->find()->where(['label LIKE' => $type.'Text%'])->order(['id' => 'ASC'])->toArray();
				$this->set(compact('texts'));				
			}

			if($type != 'acomptes')
			{
				$destinataires_clients = $this->Actions->Clients->find('all')->select(['id','nom','prenom'])->contain(['compagnies' => function($q){return $q->select(['compagnies.nom_societe']);}]);
				$destinataires_compagnies = $this->Actions->Compagnies->find('all')->select(['id','nom_societe']);
				$this->set(compact('destinataires_clients','destinataires_compagnies'));				
			}
			else
			{
				$devis = $this->Actions->find('all')->where(['a_type' => 'devis','state' => '4','factures IS NULL'])->contain(['Clients' => ['Compagnies'],'Compagnies']);
				$this->set(compact('devis'));				
			}

			if($type == 'acomptes' || $type == 'factures')
			{
				$RibsTable = TableRegistry::get('Ribs');
				$ribs = $RibsTable->find('all');
				$ribsArray['-1'] = '';
				foreach($ribs as $rib)
					$ribsArray[$rib->id] = $rib->libel;
				$this->set(compact('ribsArray'));
			}

	
			$action = $this->Actions->find()->where(['actions.id' => $id])->contain(['Articles','Clients' => ['Compagnies'],'Compagnies'])->first();
			$params = $this->Custom->getAllParams();

			if($new == 'solde')
			{
				$links = $this->Actions->find()->where(['link_id' => $action->link_id, 'id !=' => $action->id]);
				$montant = 0;
				foreach($links as $link)
				{
					$montant += $link['amounts']['acompte_ttc'];
				}
				$this->set(compact('links','montant'));
			}

			if(!in_array($action['pay_conditions'], $params['payCondition'][1]))
				$params['payCondition'][1][$action['pay_conditions']] = $action['pay_conditions'];

			if(!in_array($action['pay_type'], $params['payType']))
				$params['payType'][1][$action['pay_type']] = $action['pay_type'];

			if(!in_array($action['pay_interest'], $params['payInterest']))
				$params['payInterest'][1][$action['pay_interest']] = $action['pay_interest'];
		
			$this->set(compact('action','params'));
			$destinataire =(is_null($action['client_id']))?'compagny':'client';
			$this->set('destinataire',$destinataire);

			$this->set('topBarTitle','Modifier '.strtolower($this->Custom->getFormatedType($type)));
			$this->set('title','Modifier '.strtolower($this->Custom->getFormatedType($type)));
			if($data = $this->request->getData())
			{
				// if edit
				if(!$new)
				{
					if($type != 'acomptes')
					{
						$total_ht = 0;
						foreach($data['articles'] as $article)
							$total_ht += $article['ht_total'];
						$this->Actions->patchEntity($action,$data, ['associated' => ['Articles']]);
						$this->Actions->patchEntity($action,['ts_updated' => $this->Custom->getTs(),'total_ht' => $total_ht, 'rib_id' => (($type == 'factures')?(($data['bank_account'] < 0)?null:$data['bank_account']):null)]);				
					}
					else
					{
						$this->Actions->patchEntity($action,$data);
						$this->Actions->patchEntity($action,['ts_updated' => $this->Custom->getTs(),'rib_id' => ($data['bank_account'] > 0)?$data['bank_account']:null]);
						$currentDevis = $devis->where(['link_id' => $action->link_id])->first();
						if($currentDevis->id != $data['devis'])
						{
							$this->Actions->patchEntity($currentDevis,['link_id' => null]);
							$this->Actions->save($currentDevis);
							$newDevis = $this->Actions->get($data['devis']);
							$this->Actions->patchEntity($newDevis,['link_id' => $action->link_id]);
							$this->Actions->save($newDevis);
							$this->Actions->patchEntity($action,['devise' => $newDevis->devise,'total_ht' => $newDevis->total_ht, 'total_ttc' => $newDevis->total_ttc]);
						}
					}
					if($this->Actions->save($action))
						return $this->redirect(['controller' => 'Files', 'action' => 'pdf',$type,$action->id,true]);					
				}
				else // if new/link || duplicate
				{

					$newActions = $this->Actions->newEntity($data, ['associated' => 'Articles']);

					if($new == 'nouveau' || $new == 'solde')
					{
						$linkId = null;
						if(is_null($action->link_id))
						{
							$param = $Parameters->find()->where(['label' => 'linkId'])->first();
							$linkId = $param['parameter'] + 1;
							$Parameters->patchEntity($param,['parameter' => $param['parameter'] + 1]);
							$Parameters->save($param);
						}
						else
							$linkId = $action->link_id;		
						$this->Actions->patchEntity($newActions, ['link_id' => $linkId]);	
						$this->Actions->patchEntity($action, ['link_id' => $linkId,'factures' => true]);
						$this->Actions->save($action);				
					}

					if($new == 'solde')
						$this->Actions->patchEntity($newActions, ['solde' => true]);

					if($new == 'dupliquer')
						$this->Actions->patchEntity($newActions, ['origin_id' => $action->id]);

					if($type != 'acomptes')
					{
						$total_ht = 0;
						foreach($data['articles'] as $article)
							$total_ht += $article['ht_total'];
						
						$destinataire = explode('_', $data['destinataire']);			
						$this->Actions->patchEntity($newActions,[$destinataire[0].'_id' => $destinataire[1],'ts_created' => $this->Custom->getTs(),'total_ht' => $total_ht, 'a_type' => $type]);
						if($destinataire[0] == 'client')
						{
							$client = $this->Actions->Clients->find()->where(['clients.id' => $destinataire[1]])->contain(['Compagnies'])->first();	
							if(isset($client->compagny))
								$this->Actions->patchEntity($newActions,['compagnie_id' => $client->compagny->id]);
						}
						if($this->Actions->save($newActions))
							return $this->redirect(['controller' => 'Files', 'action' => 'pdf',$type,$newActions->id,true]);
					}
				}
			}
		}

		public function delete($id)
		{
			$action = $this->Actions->get($id);
			$type = $action->a_type;
			if(($type == 'factures' || $type == 'acomptes') && !is_null($action->link_id))
			{		
				$linkCounter = $this->Actions->find()->where(['link_id' => $action->link_id])->count();
				if($linkCounter == 2)
				{
					$devis = $this->Actions->find()->where(['link_id' => $action->link_id, 'a_type' => 'devis'])->first();
					$this->Actions->patchEntity($devis,[$type => null]);
					$this->Actions->save($devis);					
				}
			}
			if($result = $this->Actions->delete($action))
				return $this->redirect(['action' => 'index',$type]);
		}

		public function finalize($id)
		{
			$this->loadComponent('Custom');	
			$action = $this->Actions->get($id);
			$type = $action->a_type;
			$customId = $this->Custom->getCustomId($type);
			$this->Actions->patchEntity($action,['state' => 2, 'ts_finalized' => $this->Custom->getTs(), 'custom_id' => $customId]);
			if($this->Actions->save($action))
				return $this->redirect(['controller' => 'Files', 'action' => 'pdf',$type,$action->id,true]);
		}

		public function signed($id)
		{
			$this->loadComponent('Custom');
			$action = $this->Actions->get($id);
			$type = $action->a_type;
			$this->Actions->patchEntity($action,['state' => 4, 'ts_signed' => $this->Custom->getTs()]);
			if($this->Actions->save($action))
				return $this->redirect(['action' => 'view',$type,$id]);
		}

		public function refused($id,$state = 0)
		{
			$action = $this->Actions->get($id);
			$type = $action->a_type;
			$this->Actions->patchEntity($action, ['state' => $state]);
			if($this->Actions->save($action))
				return $this->redirect(['action' => 'view',$type,$id]);
		}

		public function paid($id,$cancel = false)
		{
			$this->loadComponent('Custom');
			$action = $this->Actions->get($id);
			$type = $action->a_type;
			$this->Actions->patchEntity($action, ['state' => ($cancel)?2:5, 'ts_paid' => ($cancel)?null:$this->Custom->getTs()]);
			if($this->Actions->save($action))
				return $this->redirect(['action' => 'view',$type,$id]);
		}



		public function email($type,$id)
		{
			//Il faut générer le pdf
			//$this->redirect(['action' => 'pdf',$type,$id,'email']);
			$ClientsTable = TableRegistry::get('Clients');
			$this->loadComponent('Custom');
			$action = $this->Actions->find()->where(['actions.id' => $id])->contain(['Links','Articles','Ribs','Compagnies' => ['Coordonnees'],'Clients' => ['Coordonnees','Compagnies' => ['Coordonnees']]])->first();
			$emails = $ClientsTable->find()->where(['mail IS NOT NULL'])->select(['mail']);
			foreach($emails as $email)
			{
				$arrayMail[$email->mail] = $email->mail;
			}
			$formatedType = $this->Custom->getFormatedType($action->a_type);
			$this->set('topBarTitle','<b>'.$formatedType.' '.$action->custom_id.'</b> envoi par email');
			$this->set('title',$action->custom_id.' - Envoi par email');
			$this->set(compact('action','emails','formatedType','arrayMail'));

			if($data = $this->request->getData())
			{
				$email = new Email('default');
				foreach($data['destinataire'] as $mail)
				{
					$email
						->setFrom(['noreply@mail.be' => 'Facture'])
						->setTo($mail)
						->setSubject($data['objet'])
						->attachments(APP . 'files' . DS . 'pdf' . DS . $action['custom_id'] . '.pdf')
						->send($data['message']);				
				}
				$this->Custom->flash('Le ou les emails ont été envoyés avec succès',3000,'success');
				return $this->redirect(['action' => 'view',$type,$id]);
			}
		}
	}
?>
