<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 24.07.13
 * Time: 23:39
 */

class TaskController extends Zend_Controller_Action {

    public function saveAction() {

        $params = $this->getAllParams();
        $row = Model_Db_Task::model()->save($params);
        $result = array('status' => true);

        if ($row) {
            $result['data'] = $row->toArray();
        } else {
            $result['status'] = false;
            $result['message'] = 'Произошла ошибка при сохранении задачи';
        }

        $this->getHelper('render')->sendJSON($result);
    }

    public function destroyAction() {

        $id = $this->getParam('id', false);

        if (!$id) {
            throw new Exception('Empty task id');
        }

        if (Model_Db_Task::model()->destroy($id)) {
            $result = array('status' => true);
        } else {
            $result = array('status' => false, 'message' => 'Ошибка при удалении задачи');
        }

        $this->getHelper('render')->sendJSON($result);
    }
}