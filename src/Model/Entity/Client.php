<?php
	namespace App\Model\Entity;

	use Cake\ORM\Entity;

	class Client extends Entity
	{
		protected function _setMail($mail)
		{
			if(empty($mail))
				return null;
			else
				return $mail;
		}

		protected function _setFonction($fonction)
		{
			if(empty($fonction))
				return null;
			else
				return $fonction;
		}

		protected function _setNote($note)
		{
			if(empty($note))
				return null;
			else
				return $note;
		}

		protected function _setCompagnieId($id)
		{
			if(empty($id))
				return null;
			else
				return $id;
		}
	}
?>