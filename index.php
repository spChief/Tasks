<?php
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));
defined('BASE_PATH') || define('BASE_PATH', realpath(dirname(__FILE__)));
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(BASE_PATH . '/../library'),
    get_include_path(),
)));

require_once 'Zend/Application.php';

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap();
$application->run();

function dump($var, $die = false) {

    echo "<pre>";
    var_dump($var);
    echo "</pre>";

    $die && die('---- dump die ----');
}
