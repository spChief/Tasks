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

        switch ($errors->type) {

            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:

                // 404 error -- controller or action not found
                $this->view->message   = $this->t('error::error::404');
                $this->view->errorCode = 404;
                break;

            default:
                // application error
                $this->view->message   = $this->t('error::error::500');
                $this->view->errorCode = 500;
                break;
        }

        $this->getResponse()->setHttpResponseCode($this->view->errorCode);
        $this->view->headTitle($this->view->errorCode);

        $this->view->assign(array(
            'exception' => $errors->exception,
            'request'   => $errors->request,
        ));
    }
}