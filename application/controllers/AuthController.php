<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 22:35
 */

class AuthController extends Zend_Controller_Action {

    public function preDispatch() {

        if ($this->getHelper('auth')->isAuthorized()) {
            $this->redirect('/');
        }
    }

    public function authorizeAction() {

        $form = new Form_Auth();

        if ($this->getRequest()->isPost()) {
            $params = $this->getAllParams();
            if ($form->isValid($params)) {
                if ($this->getHelper('auth')->authorize($params)) {
                    $this->redirect('/');
                } else {
                    $form->addErrorMessage('Неправильная пара логин/пароль');
                }
            }
            $form->setDefaults($params);
        }

        $this->view->assign('form', $form);
    }

    public function registerAction() {

        // TODO: registration
    }
}