<?php
	namespace App\Model\Entity;

	use Cake\ORM\Entity;
	use Cake\I18n\Time;
	use Cake\I18n\Number;

	class Action extends Entity
	{
		protected function _getStatut()
		{
			switch ($this->_properties['state']) 
			{
				case 1:
					$state = 'Provisoire';
					break;
				case 2:
					$state = 'Finalisé';
					break;
				case 3:
					$state = 'Refusé';
					break;
				case 4:
					$state = 'Signé';
					break;
				case 5:
					$state = 'Payée';
					break;
				default:
					$state = 'Provisoire';
					break;
			}
			return $state;
		}

		protected function _getFormatedType()
		{
			switch ($this->_properties['a_type']) 
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
			return $formated;
		}

		protected function _getNiceCreated()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_created']);
			$nice = $nice->i18nFormat("dd MMMM yyyy à HH'h'mm",'Europe/Paris','fr-FR');
			return $nice;
		}

		protected function _getNiceUpdated()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_updated']);
			$nice = $nice->i18nFormat("dd MMMM yyyy à HH'h'mm",'Europe/Paris','fr-FR');
			return $nice;
		}

		protected function _getNicePdf()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_pdf']);
			$nice = $nice->i18nFormat("dd MMMM yyyy à HH'h'mm",'Europe/Paris','fr-FR');
			return $nice;
		}

		protected function _getNiceFinalized()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_finalized']);
			$nice = $nice->i18nFormat("dd MMMM yyyy à HH'h'mm",'Europe/Paris','fr-FR');
			return $nice;
		}

		protected function _getNiceSigned()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_signed']);
			$nice = $nice->i18nFormat("dd MMMM yyyy à HH'h'mm",'Europe/Paris','fr-FR');
			return $nice;
		}

		protected function _getShortNiceCreated()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_created']);
			$nice = $nice->i18nFormat("dd MMMM yyyy",'Europe/Paris','fr-FR');
			return $nice;			
		}

		protected function _getShortNiceSigned()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_signed']);
			$nice = $nice->i18nFormat("dd MMMM yyyy",'Europe/Paris','fr-FR');
			return $nice;			
		}

		protected function _getNicePaid()
		{
			$nice = Time::createFromTimestamp($this->_properties['ts_paid']);
			$nice = $nice->i18nFormat("dd MMMM yyyy",'Europe/Paris','fr-FR');
			return $nice;
		}

		protected function _getAmounts()
		{
			$total = $this->_properties['total_ht'];
			if($this->_properties['remise_generale'] > 0)
			{
				if($this->_properties['remise_generale_param'] == 0)
				{
					$Amounts['remise_amount'] = ($total*($this->_properties['remise_generale']/100));
					$total -= $Amounts['remise_amount'];
				}
				else
				{
					$total -= $this->_properties['remise_generale'];
					$Amounts['remise_amount'] = $this->_properties['remise_generale'];
				}
			}
			$Amounts['total_ht_reduced'] = $total;

			if(isset($this->_properties['acompte_montant']))
			{
				if($this->_properties['acompte_montant_param'] == 0)
					$acompte = $total * ($this->_properties['acompte_montant']/100);
				else
					$acompte = $this->_properties['acompte_montant'];
				$Amounts['acompte'] = $acompte;
				$acompte += ($acompte*($this->_properties['acompte_tva']/100));
				$Amounts['acompte_ttc'] = $acompte;
			}

			return $Amounts;
		}

		protected function _setTextIntroduction($arg)
		{
			return ($arg == '')?null:$arg;
		}

		protected function _setTextConclusion($arg)
		{
			return ($arg == '')?null:$arg;
		}

		protected function _setTextFoot($arg)
		{
			return ($arg == '')?null:$arg;
		}

		protected function _setTextConditions($arg)
		{
			return ($arg == '')?null:$arg;
		}
	}
?>