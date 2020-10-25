<?php
	namespace App\Controller;

	use App\Controller\AppController;
	use Cake\ORM\TableRegistry;

	class UsersController extends AppController
	{
		public function register()
		{
			$this->viewBuilder()->setLayout('register');
			$user = $this->Users->find()->first();
			if($user)
			{
				return $this->redirect($this->Auth->redirectUrl());
			}

			if($data = $this->request->getData())
			{
				$Parameters = TableRegistry::get('Parameters');
				foreach($data as $key => $value)
				{
					if($key != 'password')
					{
						$param = $Parameters->find()->where(['label' => 'user'.ucfirst($key)])->first();
						$Parameters->patchEntity($param, ['parameter' => $value]);
						$Parameters->save($param);			
					}
				}
				$user = $this->Users->newEntity($data);
				if($this->Users->save($user))
					return $this->redirect(['action' => 'login']);
			}
		}

		public function login()
		{
			$this->viewBuilder()->setLayout('login');

			if($data = $this->request->getData())
			{
				$user = $this->Auth->identify();
				if($user)
				{
					$this->Auth->setUser($user);
					return $this->redirect($this->Auth->redirectUrl());
				}
			}
		}

		public function logout()
		{
			return $this->redirect($this->Auth->logout());
		}
	}
?>