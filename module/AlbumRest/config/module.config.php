<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bikashrai
 * Date: 7/18/13
 * Time: 10:00 PM
 * To change this template use File | Settings | File Templates.
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'AlbumRest\Controller\AlbumRest' => 'AlbumRest\Controller\AlbumRestController',
        ),
    ),
    // The following section is new` and should be added to your file
    'router' => array(
        'routes' => array(
            'album-rest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/myrest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AlbumRest\Controller\AlbumRest',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array( //Add this config
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

//    'view_manager' => array(
//        'template_path_stack' => array(
//            'album-rest' => __DIR__ . '/../view',
//        ),
//    ),
);
