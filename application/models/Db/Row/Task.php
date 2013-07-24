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
    public function canEdit() {

        $list = Model_Db_List::model()->getById($this->list_id);

        if ($list && $list->user_id == Model_Db_Users::model()->getCurrent()->id) {
            return true;
        }

        return false;
    }

    public function toArray() {

        $data = parent::toArray();

        $date = new Zend_Date($data['date_created']);
        $data['date_created'] = $date->toString(
            Zend_Date::WEEKDAY_NAME . ', ' . Zend_Date::DAY_SHORT . ' ' . Zend_Date::MONTH_NAME_SHORT . ' ' . Zend_Date::YEAR
        );

        return $data;
    }
}