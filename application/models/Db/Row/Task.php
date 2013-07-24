<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 25.07.13
 * Time: 1:03
 */

class Model_Db_Row_Task extends Zend_Db_Table_Row {

    /**
     * Check current user access to task
     * @return bool
     */
    public function canDelete() {

        $list = Model_Db_List::model()->getById($this->list_id);

        if ($list && $list->user_id == Model_Db_Users::model()->getCurrent()->id) {
            return true;
        }

        return false;
    }
}