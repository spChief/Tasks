<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 22:19
 */

class Zend_View_Helper_InitJs extends Zend_View_Helper_Abstract {

    public function initJs() {

        $this->_initVendors();
        $this->_initApplication();
        $this->_initConstants();
    }

    protected function _initVendors() {

        $this->view->headScript()->appendFile('/js/vendor/jquery.js');
        $this->view->headScript()->appendFile('/js/vendor/jquerymx.js');
    }

    protected function _initApplication() {

        $this->view->headScript()->appendFile('/js/application.js');
    }

    protected function _initConstants() {

        $this->view->headScript()->appendScript('var URL_TASK_SAVE = "' . $this->view->url(array('action' => 'save'), 'task') . '";');
        $this->view->headScript()->appendScript('var URL_TASK_DESTROY = "' . $this->view->url(array('action' => 'destroy'), 'task') . '";');
    }
}