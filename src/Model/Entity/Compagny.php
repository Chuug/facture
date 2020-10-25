<?php
	namespace App\Model\Entity;

	use Cake\ORM\Entity;

	class Compagny extends Entity
	{
		protected function _setSiren($siren)
		{
			if(empty($siren))
				return null;
			else
				return $siren;
		}

		protected function _setCode($code)
		{
			if(empty($code))
				return null;
			else
				return $code;
		}

		protected function _setTva($tva)
		{
			if(empty($tva))
				return null;
			else
				return $tva;
		}
	}
?>