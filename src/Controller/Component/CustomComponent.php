<?php
	namespace App\Controller\Component;

	use Cake\Controller\Component;
	use Cake\ORM\TableRegistry;
	use Cake\Datasource\ConnectionManager;
	use Cake\I18n\Time;

	class CustomComponent extends Component
	{

		public function flash($msg,$timer,$tp)
		{
			$this->request->getSession()->write('popup', $msg.'-'.$timer.'-'.$tp);
		}

		public function getLanguages()
		{
			return $tab = [
				'Français',
				'Anglais',
				'Néerlandais'
			];
		}

		public function getTs()
		{
			$date = new \DateTime('CET');
			return $date->getTimestamp();
		}

		public function getMonths()
		{
			for($i = 1 ; $i < 13 ; $i ++)
				$tab[0][$i] = ucfirst(Time::now()->month($i)->i18nFormat('MMMM','Europe/Paris','fr-FR'));
			$tab[1][0] = Time::now()->i18nFormat('M');
			$tab[1][1] = ucfirst(Time::now()->i18nFormat('MMMM','Europe/Paris','fr-FR'));
			return $tab;
		}

		public function getYears()
		{
			$ActionsTable = TableRegistry::get('Actions');
			$lowest = $ActionsTable->find()->where(['ts_finalized IS NOT NULL'])->order(['id' => 'ASC'])->limit(0,1)->select(['ts_finalized'])->first();
			if(empty($lowest))
				$tab[0][0] = Time::now()->i18nFormat('YYYY');
			else
				$tab[0][Time::createFromTimestamp($lowest->ts_finalized)->i18nFormat('YYYY')] = Time::createFromTimestamp($lowest->ts_finalized)->i18nFormat('YYYY');
			$highest = $ActionsTable->find()->where(['ts_finalized IS NOT NULL'])->order(['id' => 'DESC'])->limit(0,1)->select(['ts_finalized'])->first();
			if(empty($highest))
				$tab[1][1] = Time::now()->i18nFormat('YYYY');
			elseif($highest != $lowest)
				$tab[0][Time::createFromTimestamp($highest->ts_finalized)->i18nFormat('YYYY')] = Time::createFromTimestamp($highest->ts_finalized)->i18nFormat('YYYY');
			$tab[1] = Time::now()->i18nFormat('YYYY');
			return $tab;
		}

		public function getTsArea($startMonth,$startYear,$endMonth,$endYear)
		{
			$tab[0] = Time::now()->second(0)->minute(0)->hour(0)->day(1)->month($startMonth)->year($startYear)->toUnixString();
			$tab[1] = Time::now()->second(59)->minute(59)->hour(23)->day(1)->month($endMonth)->year($endYear)->modify('last day of this month')->toUnixString();
			return $tab;
		}

		public function getFormatedType($type,$plural = false)
		{
			if(!$plural)
			{
				switch ($type) 
				{
					case 'devis':
						$formated = 'Devis';
						break;
					case 'factures':
						$formated = 'Facture';
						break;
					case 'avoirs':
						$formated = 'Avoir';
						break;
					case 'acomptes':
						$formated = "Facture d'acompte";
						break;
				}				
			}
			else
			{
				switch ($type) 
				{
					case 'devis':
						$formated = 'Devis';
						break;
					case 'factures':
						$formated = 'Factures';
						break;
					case 'avoirs':
						$formated = 'Avoirs';
						break;
					case 'acomptes':
						$formated = "Factures d'acompte";
						break;
				}
			}
			return $formated;			
		}

		//Possibilité de le switch en getParams
		public function getDevises()
		{
			$Parameters = TableRegistry::get('Parameters');
			$q = $Parameters->find('all')->where(['label' => 'devise']);
			foreach ($q as $devise)
			{
				if($devise->bool == true)
					$devises[0] = $devise->id;
				
				$devises[1][$devise->id] = $devise->description.' ('.$devise->parameter.')';
			}
			return $devises;
		}

		public function getCustomId($type)
		{
			$ParametersTable = TableRegistry::get('Parameters');

			$format = $ParametersTable->find()->where(['label' => 'formatNumerotation'])->first();
			$size = $ParametersTable->find()->where(['label' => 'tailleCompteur'])->first();
			$label = $ParametersTable->find()->where(['label' => $type.'Label'])->first();
			$counter = $ParametersTable->find()->where(['label' => $type.'Counter'])->first();

			$exp = explode('.',$format->parameter);

			$date = Time::now();
			$dayShort = $date->i18nFormat('d');
			$dayLong = $date->i18nFormat('dd');
			$monthShort = $date->i18nFormat('M');
			$monthLong = $date->i18nFormat('MM');
			$yearShort = $date->i18nFormat('yy');
			$yearFull = $date->i18nFormat('yyyy');

			$len = strlen((string)$counter->parameter);

			$customId = '';
			foreach ($exp as $e) 
			{
				if($e == 'label')
					$customId .= $label->parameter;
				else if($e == 'aa')
					$customId .= $yearShort;
				else if($e == 'aaaa')
					$customId .= $yearFull;
				else if($e == 'm')
					$customId .= $monthShort;
				else if($e == 'mm')
					$customId .= $monthLong;
				else if($e == 'j')
					$customId .= $dayShort;
				else if($e == 'jj')
					$customId .= $dayLong;
				else if($e == 'n'){
					for ($i = 0; $i < ($size->parameter - $len); $i++) {
						$customId .= '0';
					}
					$customId .= $counter->parameter + 1;
				}
				else $customId .= $e;
			}

			$ParametersTable->patchEntity($counter, ['parameter' => $counter->parameter + 1]);
			if($ParametersTable->save($counter))
				return $customId;
		}

		public function getParams($param,$view = false)
		{
			$Parameters = TableRegistry::get('Parameters');
			$q = $Parameters->find('all')->where(['label' => $param])->order(['description' => 'DESC']);
			/*if($param == 'payCondition')
				$q->order(['parameter' => 'ASC']);*/
			switch ($param) {
				case 'devise':
					break;
				case 'tva':
					break;
				default:
					$q->order(['parameter' => 'ASC']);
					break;
			}
			foreach($q as $val)
			{
				if($val->bool == true)
					$array[0] = (($view)?$val->parameter:$val->id);
				$value = '';
				switch ($param) {
					case 'devise':
						$value = $val->description.' ('.$val->parameter.')';
						break;
					case 'tva':
						$value = $val->parameter.'%';
						break;
					default:
						$value = $val->parameter;
						break;
				}
				$array[1][(($view)?$val->parameter:$val->id)] = $value;
			}
			return $array;
		}

		public function getAllParams($view = true)
		{
			$ParametersTable = TableRegistry::get('Parameters');
			$tab = ['articleType','payCondition','payType','payInterest','devise','tva'];
			foreach ($tab as $param) 
			{
				$array[$param] = $this->getParams($param,$view);
			}
			$req = $ParametersTable->find()->where(['label' => 'applyTva'])->first();
			$array['applyTva'] = $req->bool;
			return $array;
		}

		public function getSoloClients($id = null)
		{
			$ClientsTable = TableRegistry::get('Clients');
			$Clients = $ClientsTable->find()->where(['compagnie_id IS NULL']);
			if(isset($id)){
				$Clients->where(['id !=' => $id]);
			}
			$tab = [];
			foreach($Clients as $client)
			{
				$tab[$client['id']] = $client->nom.' '.$client->prenom;
			}
			return $tab;
		}

		public function getBilan($startTs,$endTs)
		{
			$ActionsTable = TableRegistry::get('Actions');
			$ClientsTable = TableRegistry::get('Clients');
			$CompagniesTable = TableRegistry::get('Compagnies');

			$bilan['paidTot'] = 0;
			$bilan['paidFactureCount'] = 0;
			$bilan['unpaidTot'] = 0;
			$bilan['factureCount'] = 0;
			$bilan['avoirTot'] = 0;
			$bilan['avoirCount'] = 0;
			$bilan['devisTot'] = 0;
			$bilan['devisTotCount'] = 0;
			$bilan['devisSignedTot'] = 0;
			$bilan['devisSignedTotCount'] = 0;

			$actions = $ActionsTable->find()->where(['state >' => 1])->andWhere(['ts_finalized >' => $startTs])->andWhere(['ts_finalized <' => $endTs]);
			foreach($actions as $action)
			{
				if($action->a_type == 'factures')
				{
					$bilan['paidTot'] += ($action->state == 5)?$action->Amounts['total_ht_reduced']:0;
					$bilan['paidFactureCount'] += ($action->state == 5)?1:0;
					$bilan['unpaidTot'] += $action->Amounts['total_ht_reduced'];			
					$bilan['factureCount']++;		
				}
				if($action->a_type == 'avoirs')
				{
					$bilan['avoirTot'] += $action->Amounts['total_ht_reduced'];
					$bilan['avoirCount']++;
				}
				if($action->a_type == 'devis')
				{
					$bilan['devisTot'] += $action->Amounts['total_ht_reduced'];
					$bilan['devisTotCount']++;
					$bilan['devisSignedTot'] += ($action->state == 4)?$action->Amounts['total_ht_reduced']:0;
					$bilan['devisSignedTotCount'] += ($action->state == 4)?1:0;
				}
			}
			$bilan['clientCount'] = $ClientsTable->find()->where('is_deleted IS FALSE')->andWhere(['ts_created >' => $startTs])->andWhere(['ts_created <' => $endTs])->count();
			$bilan['compagnyCount'] = $CompagniesTable->find()->where('is_deleted IS FALSE')->andWhere(['ts_created >' => $startTs])->andWhere(['ts_created <' => $endTs])->count();
			return $bilan;
		}

		public function getCsv($array,$name)
		{
			$dl = 'download/'.$name.'.csv';
			$f = fopen($dl, 'w');
			foreach($array as $array)
				fputs($f,implode($array, ';')."\r\n");

			if(file_exists($dl))
			{
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename="'.basename($dl).'"');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($dl));
			    readfile($dl);
			    array_map('unlink', glob($dl));
			    unlink($dl);					
			}
		}
	}
?>