<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bikashrai
 * Date: 7/18/13
 * Time: 9:59 PM
 * To change this template use File | Settings | File Templates.
 */
namespace AlbumRest;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}