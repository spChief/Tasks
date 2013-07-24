<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 24.07.13
 * Time: 22:52
 */

class Zend_View_Helper_PrepareDate extends Zend_View_Helper_Abstract {

    public function prepareDate($dateStr) {

        $date = new Zend_Date($dateStr);

        return $date->toString(
            Zend_Date::WEEKDAY_NAME . ', ' . Zend_Date::DAY_SHORT . ' ' . Zend_Date::MONTH_NAME_SHORT . ' ' . Zend_Date::YEAR
        );
    }
}