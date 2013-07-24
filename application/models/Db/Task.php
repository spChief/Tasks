<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 24.07.13
 * Time: 20:53
 */

class Model_Db_Task extends Core_Db_Table {

    protected $_name = 'tasks';

    protected $_rowClass = 'Model_Db_Row_Task';

    public static function model() {

        return new self();
    }

    public function getByListId($listId) {

        $select = $this->select();
        $select->where('list_id = ?', $listId);

        return $this->fetchAll($select);
    }

    public function save($data) {

        if (!$data['id']) {
            return $this->createTask($data);
        } else {
            return $this->updateTask($data);
        }
    }

    public function createTask($data) {

        $row = $this->createRow($data);

        if ($row->save()) {
            return $row;
        } else {
            return false;
        }
    }

    public function updateTask($data) {

        $row = $this->getById($data['id']);

        if ($row) {
            $row->setFromArray($data);

            if ($row->save()) {
                return $row;
            }
        }

        return false;
    }

    public function destroy($id) {

        $row = $this->getById($id);

        if ($row && $row->canDelete()) {
            return $row->delete();
        } else {
            return false;
        }
    }
}