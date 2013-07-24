<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 24.07.13
 * Time: 20:52
 */

class Model_Db_Row_List extends Zend_Db_Table_Row {

    public function getTasks() {

        return Model_Db_Task::model()->getByListId($this->id);
    }
}