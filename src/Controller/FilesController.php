<?php
	namespace App\Controller;

	use App\Controller\AppController;
	use Cake\ORM\TableRegistry;
	use Cake\Core\Configure;
	use Cake\I18n\Time;
	use Cake\Filesystem\Folder;
	use Cake\Filesystem\File;

	use Cake\Http\Response;

	class FilesController extends AppController
	{
		public function pdf($type,$id,$redirect = false)
		{
			$this->loadComponent('Custom');
			$this->viewBuilder()->setLayout('empty');
			$Parameters = TableRegistry::get('Parameters');
			$ActionsTable = TableRegistry::get('Actions');
			$emetteur = $Parameters->find()->where(['label LIKE' => 'user%'])->order(['id' => 'ASC'])->toArray();
			$action = $ActionsTable->find()->where(['actions.id' => $id])->contain(['Links','Articles','Ribs','Compagnies' => ['Coordonnees'],'Clients' => ['Coordonnees','Compagnies' => ['Coordonnees']]])->first();

			$this->set('formatedType',$this->Custom->getFormatedType($type));

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

			//debug($action);
			//die();
			$date  = null;
			if(!is_null($action['ts_finalized'])){
				$date = Time::createFromTimestamp($action['ts_finalized']);
				$date = $date->i18nFormat('dd MMMM yyyy', 'Europe/Paris', 'fr-FR');				
			}

			if($action['solde'])
			{
				$acomptes = $ActionsTable->find()->where(['link_id' => $action->link_id, 'a_type' => 'acomptes']);
				$this->set(compact('acomptes'));
			}

			$this->set(compact('action','emetteur','date','type'));

			Configure::write('CakePdf', [
			    'engine' => [
			    	'className' => 'CakePdf.WkHtmlToPdf',
			    	'binary' => 'C:\wkhtmltopdf\bin\wkhtmltopdf.exe',
			    	'options' => [
			    		'footer-right' => 'Page [page] sur [toPage]',
			    		'footer-left' => $action['custom_id']
			    	]
			    ],
			    'margin' => [
			        'bottom' => 10,
			        'left' => 10,
			        'right' => 10,
			        'top' => 10
			    ]
			]);
			$CakePdf = new \CakePdf\Pdf\CakePdf();
			$CakePdf->template('pdf','default');
    		$CakePdf->viewVars($this->viewVars);
    		$path = APP . 'files' . DS . 'pdf' . DS . (($action['state'] == 1)?$action['id']:$action['custom_id']) . '.pdf'; 
			
			if($pdf = $CakePdf->write($path))
			{
				$ActionsTable->patchEntity($action,['ts_pdf' => $this->Custom->getTs()]);
				$ActionsTable->save($action);
			}

			if($redirect)
				return $this->redirect(['controller' => 'Actions', 'action' => 'view',$type,$id]);
		}

		public function pdfview($id)
		{
			$ActionsTable = TableRegistry::get('Actions');
			$action = $ActionsTable->get($id);
			if($action->state == 1)
				$fileName = $action->id;
			else
				$fileName = $action->custom_id;

			$path = APP . 'files' . DS . 'pdf' . DS . $fileName . '.pdf';

			$file = $this->response->withFile($path);
			return $file;
		}
	}
?>