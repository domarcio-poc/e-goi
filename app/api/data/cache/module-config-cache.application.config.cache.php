<?php
return array (
  'service_manager' => 
  array (
    'aliases' => 
    array (
      'FilterManager' => 'Zend\\Filter\\FilterPluginManager',
      'InputFilterManager' => 'Zend\\InputFilter\\InputFilterPluginManager',
      'HttpRouter' => 'Zend\\Router\\Http\\TreeRouteStack',
      'router' => 'Zend\\Router\\RouteStackInterface',
      'Router' => 'Zend\\Router\\RouteStackInterface',
      'RoutePluginManager' => 'Zend\\Router\\RoutePluginManager',
      'ValidatorManager' => 'Zend\\Validator\\ValidatorPluginManager',
    ),
    'factories' => 
    array (
      'Zend\\Filter\\FilterPluginManager' => 'Zend\\Filter\\FilterPluginManagerFactory',
      'Zend\\Paginator\\AdapterPluginManager' => 'Zend\\Paginator\\AdapterPluginManagerFactory',
      'Zend\\Paginator\\ScrollingStylePluginManager' => 'Zend\\Paginator\\ScrollingStylePluginManagerFactory',
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
  'view_manager' => 
  array (
    'strategies' => 
    array (
      0 => 'ViewJsonStrategy',
    ),
  ),
  'controllers' => 
  array (
    'factories' => 
    array (
      'Category\\API\\Category' => 'Category\\API\\CategoryFactory',
    ),
  ),
  'db' => 
  array (
    'inmemo' => 
    array (
      'filename' => '/home/silvanogues/src/e-goi/app/api/data/storage/categories.json',
    ),
  ),
);