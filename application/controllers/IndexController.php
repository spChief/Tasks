<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 19:32
 */

class IndexController extends Zend_Controller_Action {

    public function indexAction() {


        $this->view->assign('list', (object)array(
            'title' => 'Some list',
            'tasks' => array()
        ));
    }
}