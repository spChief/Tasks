<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 23:31
 */

class Zend_Controller_Action_Helper_Auth extends Zend_Controller_Action_Helper_Abstract {

    public function authorize($params = array()) {

        $auth = Zend_Auth::getInstance();
        $authAdapter = Model_Db_Users::model()->getAuthAdapter();
        $authAdapter->setIdentity($params['login'])
            ->setCredential($params['password']);

        $result = $auth->authenticate($authAdapter);


        if ($result->isValid()) {
            Zend_Session::regenerateId();
            return true;
        } else {
            return false;
        }
    }

    public function isAuthorized() {

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            return true;
        } else {
            return false;
        }
    }
}