<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Custom');

        $Users = TableRegistry::get('Users');
        $user = $Users->find()->first();
        if(is_null($user) && $this->request->getParam('action') != 'register')
        {
            return $this->redirect(['controller' => 'Users', 'action' => 'register']);
        }
        elseif(!is_null($user))
        {

            $this->loadComponent('Auth', [
                'authenticate' => [
                    'form' => [
                        'fields' => [
                            'username' => 'mail',
                            'password' => 'password'
                        ]
                    ]
                ],
                'loginRedirect' => [
                    'controller' => 'Dashboard',
                    'action' => 'index'
                ],
                'logoutRedirect' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
            ]);
        }

        if($this->request->getParam('Controller') != 'Dashboard' && $this->request->getParam('action') != 'search')
        {
            $check = $this->request->getSession()->check('popup');
            $PF = ($check)?$this->request->getSession()->read('popup'):'';
            $this->request->getSession()->delete('popup');
            $this->set(compact('PF'));            

            $this->set('searchBar',($this->request->getParam('action') == 'index')?true:false);

            if($this->request->getParam('controller') != 'Ajax')
                $this->set('navActive','');            
        }

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);

        $this->loadComponent('Flash');



        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */


    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->getType(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    
}
