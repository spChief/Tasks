<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 24.07.13
 * Time: 20:43
 */

class Core_Db_Table extends Zend_Db_Table {

    public function getById($id) {

        $select = $this->select();
        $select->where('id = ?', $id);

        return $this->fetchRow($select);
    }
}