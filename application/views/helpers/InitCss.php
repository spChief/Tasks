<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 22:19
 */

class Zend_View_Helper_InitCss extends Zend_View_Helper_Abstract {

    public function initCss() {
        $this->view->headLink()->appendStylesheet('/css/styles.css');
    }
}