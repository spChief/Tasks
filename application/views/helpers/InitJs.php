<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 22:19
 */

class Zend_View_Helper_InitJs extends Zend_View_Helper_Abstract {

    public function initJs() {

        $this->view->headScript()->appendFile('/js/vendor/jquery.js');
        $this->view->headScript()->appendFile('/js/vendor/jquerymx.js');
        $this->view->headScript()->appendFile('/js/application.js');
    }
}