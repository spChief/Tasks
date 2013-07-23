<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aleksey Demkin
 * Date: 23.07.13
 * Time: 19:38
 */

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initAutoload() {

        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace'     => '',
            'basePath'      => APPLICATION_PATH,
            'resourceTypes' => array(
                'core'  => array(
                    'namespace' => 'Core',
                    'path'      => 'core',
                ),
                'class' => array(
                    'namespace' => 'Class',
                    'path'      => 'class',
                ),
            ),
        ));

        return $moduleLoader;
    }

    /**
     * Init Routes
     * @return Zend_Controller_Router_Interface
     */
    protected function _initRouting() {

        $front  = Zend_Controller_Front::getInstance();
        $routes = new Zend_Config_Ini(APPLICATION_PATH . '/configs/routes.ini', 'production');

        $router = $front->getRouter();
        $router->addConfig($routes, 'routes');

        return $router;
    }

    /**
     * Init Front Controller Plugins
     * @return void
     */
    protected function _initPlugins() {

        $front = Zend_Controller_Front::getInstance()
            ->registerPlugin(new Plugin_Auth());
    }

    /**
     * Init Action helpers
     */
    protected function _initActionHelpers() {

        Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH . '/controllers/helpers');
    }
}