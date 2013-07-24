<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 19:32
 */

class IndexController extends Zend_Controller_Action {

    public function indexAction() {

        $listModel = new Model_Db_List();
        $listActive = $listModel->getActive();
//        $listSet = $listModel->getList();

        $this->view->assign(array(
            'listActive' => $listActive,
//            'listSet' => $listSet, // TODO
        ));
    }
}