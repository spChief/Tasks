<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 23:33
 */

class Model_Db_Users extends Zend_Db_Table_Abstract {

    protected $_name = "users";

    protected $_columnIdentity = 'login';
    protected $_columnCredential = 'password';
    protected $_credentialTreatment = 'MD5(CONCAT(?, "sometasks"))';

    public static function model() {

        return new self();
    }

    /**
     * Returning Auth adapter
     * @return Zend_Auth_Adapter_DbTable
     */
    public function getAuthAdapter() {

        return new Zend_Auth_Adapter_DbTable(
            $this->getAdapter(),
            $this->_name,
            $this->_columnIdentity,
            $this->_columnCredential,
            $this->_credentialTreatment
        );
    }
}