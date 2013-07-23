<?php
class Zend_Controller_Action_Helper_Render extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Direct
     * @return Zend_Controller_Action_Helper_Render
     */
    function direct() {

        return $this;
    }

    /**
     * Disable default rendering
     * @param bool $disable
     * @return Zend_Controller_Action_Helper_Render
     */
    function setNoRender($disable = true) {
        $this->getActionController()->getHelper('viewRenderer')->setNoRender(true);
        $this->getActionController()->getHelper('layout')->disableLayout();

        return $this;
    }

    /**
     * Set header to plain text
     * @param bool $disable
     * @return Zend_Controller_Action_Helper_Render
     */
    function setPlainText($disable = true) {

        $this->getActionController()->getResponse()->setHeader('content-type', 'text/plain', true);

        return $this;
    }

    /**
     * Set JSON content type
     * @return Zend_Controller_Action_Helper_Render
     */
    function setJSON() {
        $this->getActionController()->getResponse()->setHeader('content-type', 'application/json', true);

        return $this;
    }

    /**
     * Send JSON data to client
     * @param mixed $data
     * @return Zend_Controller_Action_Helper_Render
     */
    function sendJSON($data) {
        $this->setNoRender();
        $this->setJSON();

        $result = json_encode($data);
        $this->getActionController()->getResponse()->setBody($result);

        return $this;
    }
}
