<?php

declare(strict_types=1);

namespace Category;

use Ramsey\Uuid\Uuid;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\View\Model\JsonModel;
use Zend\Http\Header\GenericHeader;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    /*
    public function onDispatch(MvcEvent $e)
    {
        $cid = $e->getRequest()->getHeader('x-cid');
        if (empty($cid)) {
            $uuid = Uuid::uuid4();
            $cid  = $uuid->toString();
        }

        if ($cid instanceof GenericHeader) {
            $cid = $cid->getFieldValue();
        }

        $response = $e->getResponse();

        $headers = $e->getRequest()->getHeaders();
        $headers->addHeaderLine('x-cid', $cid);

        $viewModel = $e->getViewModel();
        if ($viewModel instanceof JsonModel) {
            $headers->addHeaderLine('Content-Type', 'application/json');
        }

        $response->setHeaders($headers);

        return $response;
    }

    publicCheckventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(
            MvcEvent::EVENT_RENDER,
            [$this, 'onDispatch'],
        );
    }
    */

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ]
            ]
        ];
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
