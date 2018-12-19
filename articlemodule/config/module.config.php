<?php

return [
    'router' => [
        'routes' => [
            'entitygenerator3' => [
                'type'    => 'Literal',
                'priority' => 9999,
                'options' => [
                    'route'    => '/article/entitygenerator',
                    'defaults' => [
                        'controller' => 'Article\Controller\Developer',
                        'action' => 'entitygenerator',
                    ],
                ],
            ],
            'modelgenerator3' => [
                'type'    => 'Literal',
                'priority' => 9999,
                'options' => [
                    'route'    => '/article/modelgenerator',
                    'defaults' => [
                        'controller' => 'Article\Controller\Developer',
                        'action' => 'modelgenerator',
                    ],
                ],
            ],
            'articletest' => [
                'type'    => 'Literal',
                'priority' => 9999,
                'options' => [
                    'route'    => '/article/test',
                    'defaults' => [
                        'controller' => 'Article\Controller\Test',
                        'action' => 'index',
                    ],
                ],
            ],
            'newsdetail1' => [
                'type' => 'Segment',
                'priority' => 9999,
                'options' => [
                    'route' =>'/'. \Base\Settings\Settings::getParams(['routing' => 'aktualnosci']),
                    'constraints' => [
                        'title' => '[\s\S]+',
                        'id'     => '\d*',
                    ],
                    'defaults' => [
                        'controller'    => 'Article\Controller\Index',
                        'action' => 'detail1',
                        'id' => 0,
                        'title' => ""
                    ]
                ],
            ],
            'searcharchitecture' => [
                'type' => 'Segment',
                'priority' => 9999,
                'options' => [
                    'route' =>\Article\Form\ArchitectureSearchForm::$linkPrefix.'[/:params]',
                    'constraints' => [
                        'params' => '[a-zA-Z0-9-/_]*',
                    ],
                    'defaults' => [
                        'controller'    => 'Article\Controller\Index',
                        'action' => 'searcharchitecture'
                    ]
                ],
            ],
            'searchproducts' => [
                'type' => 'Segment',
                'priority' => 9999,
                'options' => [
                    'route' => \Article\Form\ProductsSearchForm::$linkPrefix.'[/:params]',
                    'constraints' => [
                        'params' => '[a-zA-Z0-9-/_]*',
                    ],
                    'defaults' => [
                        'controller'    => 'Article\Controller\Index',
                        'action' => 'searchproducts'
                    ]
                ],
            ],
            'searchnews' => [
                'type' => 'Segment',
                'priority' => 9999,
                'options' => [
                    'route' => \Article\Form\NewsSearchForm::$linkPrefix.'[/:params]',
                    'constraints' => [
                        'params' => '[a-zA-Z0-9-/_]*',
                    ],
                    'defaults' => [
                        'controller'    => 'Article\Controller\Index',
                        'action' => 'searchnews'
                    ]
                ],
            ],
            'newsdetail2' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/'.\Base\Settings\Settings::getParams(['routing' => 'porady']),
                    'constraints' => [
                        'title' => '[\s\S]+',
                        'id'     => '\d*',
                    ],
                    'defaults' => [
                        'controller'    => 'Article\Controller\Index',
                        'action' => 'detail2',
                        'id' => 0,
                        'title' => ""
                    ]
                ],
            ],
            'newsdetail3' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/'.\Base\Settings\Settings::getParams(['routing' => 'aktualnoscityp3']),
                    'constraints' => [
                        'title' => '[\s\S]+',
                        'id'     => '\d*',
                    ],
                    'defaults' => [
                        'controller'    => 'Article\Controller\Index',
                        'action' => 'detail3',
                        'id' => 0,
                        'title' => ""
                    ]
                ],
            ],
            'library' => [
                'type' => 'Literal',
                'priority' => 9999,
                'options' => [
                    'route' =>'/library',
                    'defaults' => [
                        'controller'    => 'Article\Controller\Library',
                        'action' => 'list'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [

                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'constraints' => [
                                'id'     => '\d*',
                            ],
                            'defaults' => [
                                'controller'    => 'Article\Controller\Library',
                                'action' => 'add'
                            ]
                        ],
                    ],
                    'addajax' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/addajax/:id',
                            'constraints' => [
                                'id'     => '\d*',
                            ],
                            'defaults' => [
                                'controller'    => 'Article\Controller\Library',
                                'action' => 'addajax',
                                'id' => 0,
                            ]
                        ],
                    ],
                    'remove' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/remove/:id',
                            'constraints' => [
                                'id'     => '\d*',
                            ],
                            'defaults' => [
                                'controller'    => 'Article\Controller\Library',
                                'action' => 'remove',
                                'id' => 0,
                            ]
                        ],
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Article\Controller\Test' => 'Article\Controller\TestController',
            'Article\Controller\Developer' => 'Article\Controller\DeveloperController',
            'Article\Controller\Index' => 'Article\Controller\IndexController',
            'Article\Controller\Library' => 'Article\Controller\LibraryController',
        ],
    ],
    'view_manager' => [

        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'ArticleSearch' => 'Article\Service\ArticleSearch',
            'Categories' => 'Article\Service\CategoriesService',
            'Library' => 'Article\Service\LibraryService',
            'Article\Search\Filter\Bim' => 'Article\Search\Filter\Bim'
        ],
        'factories' => [
            'Article\Model\CmsNews' => function($sm){
                $model = new Article\Model\CmsNewsModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsFiles' => function($sm){
                $model = new Article\Model\CmsNewsFilesModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsCategory' => function($sm){
                $model = new Article\Model\CmsNewsCategoryModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsCategoryList' => function($sm){
                $model = new Article\Model\CmsNewsCategoryListModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsComments' => function($sm){
                $model = new Article\Model\CmsNewsCommentsModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsRelation' => function($sm){
                $model = new Article\Model\CmsNewsRelationModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsTags' => function($sm){
                $model = new Article\Model\CmsNewsTagsModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsType' => function($sm){
                $model = new Article\Model\CmsNewsTypeModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsGallery' => function($sm){
                $model = new Article\Model\CmsGalleryModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsGalleryCategory' => function($sm){
                $model = new Article\Model\CmsGalleryCategoryModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsGalleryCategoryList' => function($sm){
                $model = new Article\Model\CmsGalleryCategoryListModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsGalleryGroup' => function($sm){
                $model = new Article\Model\CmsGalleryGroupModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsGalleryPhoto' => function($sm){
                $model = new Article\Model\CmsGalleryPhotoModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsGalleryPhotoLangs' => function($sm){
                $model = new Article\Model\CmsGalleryPhotoLangsModel();
                $model->setServiceLocator($sm); return $model; },
            'Article\Model\CmsNewsUzytkownicy' => function($sm){
                $model = new Article\Model\CmsNewsUzytkownicyModel();
                $model->setServiceLocator($sm); return $model; },
        ]
    ],
    'view_helpers' => [
        'invokables' => [
            'menuCategory' => 'Article\View\Helper\MenuCategory',
            'libraryWidget' => 'Article\View\Helper\LibraryWidget'
        ],
    ],
];
