<?php
return array (
  'service_manager' => 
  array (
    'aliases' => 
    array (
      'InputFilterManager' => 'Zend\\InputFilter\\InputFilterPluginManager',
      'HttpRouter' => 'Zend\\Router\\Http\\TreeRouteStack',
      'router' => 'Zend\\Router\\RouteStackInterface',
      'Router' => 'Zend\\Router\\RouteStackInterface',
      'RoutePluginManager' => 'Zend\\Router\\RoutePluginManager',
      'ValidatorManager' => 'Zend\\Validator\\ValidatorPluginManager',
    ),
    'factories' => 
    array (
      'Zend\\InputFilter\\InputFilterPluginManager' => 'Zend\\InputFilter\\InputFilterPluginManagerFactory',
      'Zend\\Router\\Http\\TreeRouteStack' => 'Zend\\Router\\Http\\HttpRouterFactory',
      'Zend\\Router\\RoutePluginManager' => 'Zend\\Router\\RoutePluginManagerFactory',
      'Zend\\Router\\RouteStackInterface' => 'Zend\\Router\\RouterFactory',
      'Zend\\Validator\\ValidatorPluginManager' => 'Zend\\Validator\\ValidatorPluginManagerFactory',
      'Category\\Repository\\CategoryInterface' => 'Category\\Repository\\CategoryFactory',
    ),
  ),
  'input_filters' => 
  array (
    'abstract_factories' => 
    array (
      0 => 'Zend\\InputFilter\\InputFilterAbstractServiceFactory',
    ),
  ),
  'route_manager' => 
  array (
  ),
  'router' => 
  array (
    'routes' => 
    array (
      'home' => 
      array (
        'type' => 'Zend\\Router\\Http\\Literal',
        'options' => 
        array (
          'route' => '/',
          'defaults' => 
          array (
            'controller' => 'Application\\Controller\\IndexController',
            'action' => 'index',
          ),
        ),
      ),
      'application' => 
      array (
        'type' => 'Zend\\Router\\Http\\Segment',
        'options' => 
        array (
          'route' => '/application[/:action]',
          'defaults' => 
          array (
            'controller' => 'Application\\Controller\\IndexController',
            'action' => 'index',
          ),
        ),
      ),
      'categories' => 
      array (
        'type' => 'literal',
        'options' => 
        array (
          'route' => '/categories',
          'defaults' => 
          array (
            'controller' => 'Category\\Controller\\Categories',
            'action' => 'index',
          ),
        ),
      ),
      'restful_category' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/category[/:id]',
          'constraints' => 
          array (
            'id' => '[0-9]+',
          ),
          'defaults' => 
          array (
            'controller' => 'Category\\API\\Category',
          ),
        ),
      ),
    ),
  ),
  'controllers' => 
  array (
    'factories' => 
    array (
      'Application\\Controller\\IndexController' => 'Zend\\ServiceManager\\Factory\\InvokableFactory',
      'Category\\API\\Category' => 'Category\\API\\CategoryFactory',
    ),
    'invokables' => 
    array (
      'Category\\Controller\\Categories' => 'Category\\Controller\\Categories',
    ),
  ),
  'view_manager' => 
  array (
    'display_not_found_reason' => true,
    'display_exceptions' => true,
    'doctype' => 'HTML5',
    'not_found_template' => 'error/404',
    'exception_template' => 'error/index',
    'template_map' => 
    array (
      'layout/layout' => '/app/module/Application/config/../view/layout/layout.phtml',
      'application/index/index' => '/app/module/Application/config/../view/application/index/index.phtml',
      'error/404' => '/app/module/Application/config/../view/error/404.phtml',
      'error/index' => '/app/module/Application/config/../view/error/index.phtml',
    ),
    'template_path_stack' => 
    array (
      0 => '/app/module/Application/config/../view',
      1 => '/app/module/Category/config/../view',
    ),
    'strategies' => 
    array (
      0 => 'ViewJsonStrategy',
    ),
  ),
  'db' => 
  array (
    'inmemo' => 
    array (
      'filename' => '/app/data/storage/categories.json',
    ),
  ),
);