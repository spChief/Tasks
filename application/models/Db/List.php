<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 20:56
 */

class Model_Db_List extends Core_Db_Table {

    protected $_name = 'lists';

    protected $_rowClass = 'Model_Db_Row_List';

    public static function model() {

        return new self();
    }

    public function getList() {

        $select = $this->select();
        $select->where('user_id = ?', Model_Db_Users::model()->getCurrent()->id);

        return $this->fetchAll($select);
    }

    public function getActive() {

        $select = $this->select();
        $select->where('user_id = ?', Model_Db_Users::model()->getCurrent()->id)
            ->where('active = ?', 1);

        return $this->fetchRow($select);
    }
}
