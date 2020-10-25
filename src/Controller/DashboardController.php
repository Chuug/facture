<?php
	namespace App\Controller;

	use App\Controller\AppController;
	use Cake\ORM\TableRegistry;
	use Cake\I18n\Time;

	class DashboardController extends AppController
	{
		public function index()
		{
			$this->set('title','Dashboard');
			$this->set('topBarTitle','Dashboard');
			$ActionsTable = TableRegistry::get('Actions');
			$ClientsTable = TableRegistry::get('Clients');
			$CompagniesTable = TableRegistry::get('Compagnies');

			$months = $this->Custom->getMonths();
			$years = $this->Custom->getYears();
			$nowArea = $this->Custom->getTsArea($months[1][0],$years[1],$months[1][0],$years[1]);
			$this->set(compact('months','years'));

			$bilan = $this->Custom->getBilan($nowArea[0],$nowArea[1]);

			$this->set(compact('bilan'));

			if($data = $this->request->getData())
			{		

				$filename = 'cloture-comptable__';
				$filename .= ( ($data['startMonth'] == $data['endMonth']) && ($data['startYear'] == $data['endYear']) )?$data['startMonth'].'-'.$data['startYear']:$data['startMonth'].'-'.$data['startYear'].'_'.$data['endMonth'].'-'.$data['endYear'];
				$areas = $this->Custom->getTsArea($data['startMonth'],$data['startYear'],$data['endMonth'],$data['endYear']);

				$actions = $ActionsTable->find()->where(['actions.state >' => 1])->andWhere(['a_type !=' => 'acomptes'])->andWhere(['a_type !=' => 'devis'])->andWhere(['actions.ts_finalized >' => $areas[0]])->andWhere(['actions.ts_finalized <' => $areas[1]])->order(['actions.ts_finalized' => 'ASC'])->contain(['Articles','Clients' => ['Compagnies','Coordonnees'],'Compagnies' => ['Coordonnees']]);

				$array[0] = [
					'ID',
					'Date',
					'Société',
					'Nom',
					'Adresse',
					"Numéro d'entreprise",
					"Code d'activité",
					"Numéro de TVA",
					"Numéro de téléphone",
					"Adresse email",
					"Site internet",
					"Devise",
					"Montant HT",
					"Montant TVA",
					"Montant TTC"
				];

				$totalHT = 0;
				$totalTVA = 0;
				$totalTTC = 0;
				$avoirHT = 0;
				$avoirTVA = 0;
				$avoirTTC = 0;
				$i = 1;

				foreach($actions as $action)
				{
					if(isset($action->client->coordonnee))
					{
						$adresse = ((isset($action->client->coordonnee->adresse))?$action->client->coordonnee->adresse.' ':'').((isset($action->client->coordonnee->code_postal))?$action->client->coordonnee->code_postal.' ':'').((isset($action->client->coordonnee->ville))?$action->client->coordonnee->ville.' ':'').((isset($action->client->coordonnee->pays))?$action->client->coordonnee->pays:'');
					}
					if(isset($action->compagny->coordonnee))
					{
						$adresse = ((isset($action->compagny->coordonnee->adresse))?$action->compagny->coordonnee->adresse.' ':'').((isset($action->compagny->coordonnee->code_postal))?$action->compagny->coordonnee->code_postal.' ':'').((isset($action->compagny->coordonnee->ville))?$action->compagny->coordonnee->ville.' ':'').((isset($action->compagny->coordonnee->pays))?$action->compagny->coordonnee->pays:'');
					}

					$tva = 0;
					if($action->tva_non_applicable)
						$tva = 0;
					else
					{
						if(isset($action->remise_generale))
						{
							$tvaPercent = $action->articles[0]->tva;
							$tva = $action['Amounts']['total_ht_reduced']*($tvaPercent/100);
						}
						else
						{
							foreach($action->articles as $article)
								$tva += ($article->ttc_total - $article->ht_total);
						}

						
					}
					$array[$i] = [
						$action->custom_id,
						Time::createFromTimestamp($action->ts_finalized)->i18nFormat("dd/MM/yyyy HH:mm",'Europe/Paris','fr-FR'),
						(isset($action->compagny) || isset($action->client->compagny))?(isset($action->client->compagny))?$action->client->compagny->nom_societe:$action->compagny->nom_societe:'',
						(isset($action->client))?$action->client->prenom.' '.$action->client->nom:'',
						$adresse,
						(isset($action->compagny->siren))?$action->compagny->siren:'',
						(isset($action->compagny->code))?$action->compagny->code:'',
						(isset($action->compagny->tva))?$action->compagny->tva:'',
						(isset($action->compagny->coordonnee->telephone) || isset($action->client->coordonnee->telephone))?((isset($action->compagny->coordonnee->telephone))?$action->compagny->coordonnee->telephone:$action->client->coordonnee->telephone):'',
						(isset($action->client->mail))?$action->client->mail:'',
						(isset($action->compagny->coordonnee->website) || isset($action->client->coordonnee->website))?((isset($action->compagny->coordonnee->website))?$action->compagny->coordonnee->website:$action->client->coordonnee->website):'',
						$action->devise,
						(($action->a_type == 'avoirs')?'-':'').number_format($action['Amounts']['total_ht_reduced'],2,',',' '),
						(($action->a_type == 'avoirs')?'-':'').number_format($tva,2,',',' '),
						(($action->a_type == 'avoirs')?'-':'').number_format($action['Amounts']['total_ht_reduced'] + $tva,2,',',' '),

					];				
					if($action->a_type == 'avoirs')
					{
						$avoirHT += $action['Amounts']['total_ht_reduced'];
						$avoirTVA += $tva;
					}
					else
					{
						$totalHT += $action['Amounts']['total_ht_reduced'];
						$totalTVA += $tva;
					}

					$i++;
				}
				$array[$i] = [''];
				$i++;

				$array[$i] = ['','','','','','','','','','','','Totaux',number_format($totalHT-$avoirHT,2,',',' '),number_format($totalTVA-$avoirTVA,2,',',' '),number_format(($totalHT-$avoirHT)+($totalTVA-$avoirTVA),2,',',' ')
				];

				$this->Custom->getCsv($array,$filename);		
			}
		}

		public function search($search)
		{
			$this->viewBuilder()->setLayout('search');

			$ClientsTable = TableRegistry::get('Clients');
			$CompagniesTable = TableRegistry::get('Compagnies');
			$ActionsTable = TableRegistry::get('Actions');

			if(empty($search))
			{
				return false;
			}
			elseif(ctype_alpha($search))
			{
				$clients = $ClientsTable->find()->where(['nom LIKE' => '%'.$search.'%'])->orWhere(['prenom LIKE' => '%'.$search.'%'])->contain(['Compagnies'])->select(['id','nom','prenom','compagnies.nom_societe'])->toArray();
				$compagnies = $CompagniesTable->find()->where(['nom_societe LIKE' => '%'.$search.'%'])->select(['id','nom_societe'])->toArray();
				$this->set(compact('clients','compagnies'));
			}
			elseif(ctype_digit($search))
			{
				$len = strlen($search);
				debug($len);
				if($len == 2 || $len == 4)
				{
					$yearStart = Time::now()->year(($len == 2)?'20'.$search:$search)->month(1)->day(1)->hour(0)->minute(0)->second(0)->toUnixString();
					$yearEnd = Time::now()->year(($len == 2)?'20'.$search + 1:$search + 1)->month(1)->day(1)->hour(0)->minute(0)->second(0)->toUnixString();
					$actions = $ActionsTable->find()->where(['ts_finalized >' => $yearStart,'ts_finalized <' => $yearEnd])->toArray();
							
					debug($actions);	
				}
			}
			elseif(count($exp = explode(':', $search)) > 1)
			{
				if($exp[0] == 'client' && !empty($exp[1]))
				{
					$clients = $ClientsTable->find()->where(['nom LIKE' => '%'.$exp[1].'%'])->orWhere(['prenom LIKE' => '%'.$exp[1].'%'])->contain(['Compagnies'])->select(['id','nom','prenom','compagnies.nom_societe'])->toArray();
					$this->set(compact('clients'));			
				}

				if($exp[0] == 'societe' && !empty($exp[1]))
				{
					$compagnies = $CompagniesTable->find()->where(['nom_societe LIKE' => '%'.$exp[1].'%'])->select(['id','nom_societe'])->toArray();
					$this->set(compact('compagnies'));			
				}

				if($exp[0] == 'devis' || $exp[0] == 'factures' || $exp[0] == 'acomptes' || $exp[0] == 'avoirs')
				{
					$actions = $ActionsTable->find()->where(['custom_id LIKE' => $exp[1].'%'])->andWhere(['a_type' => $exp[0]])->contain(['Clients','Compagnies'])->select(['id','custom_id','total_ht','devise','clients.nom','clients.prenom','compagnies.nom_societe'])->toArray();
					$this->set('type',$exp[0]);
					$this->set(compact('actions'));
				}
			}
		}

		public function test()
		{
			$ActionsTable = TableRegistry::get('Actions');
			$actions = $ActionsTable->find('all')->contain(['Clients' => ['Compagnies']]);
			foreach($actions as $action)
			{
				if(isset($action->client_id))
				{
					if(isset($action->client->compagny))
					{
						$ActionsTable->patchEntity($action,['compagnie_id' => $action->client->compagny->id]);
						$ActionsTable->save($action);
						debug($action);
					}
				}
			}
		
			die();
		}
	}
?>