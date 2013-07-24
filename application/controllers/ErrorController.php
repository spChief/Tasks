<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 19:46
 */

class ErrorController extends Zend_Controller_Action {

    public function errorAction() {
        $errors    = $this->_getParam('error_handler');
        $exception = $errors['exception'];
    }
}