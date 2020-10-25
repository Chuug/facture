<?php
	namespace App\Model\Entity;

	use Cake\ORM\Entity;

	class Coordonnee extends Entity
	{
		protected function _setAdresse($adresse)
		{
			if(empty($adresse))
				return null;
			else
				return $adresse;
		}

		protected function _setVille($ville)
		{
			if(empty($ville))
				return null;
			else
				return $ville;
		}

		protected function _setWebsite($website)
		{
			if(empty($website))
				return null;
			else
				return $website;
		}

		protected function _setTelephone($telephone)
		{
			if(empty($telephone))
				return null;
			else
				return $telephone;
		}

		protected function _setCplAdresse($cpl)
		{
			if(empty($cpl))
				return null;
			else
				return $cpl;
		}
	}
?>