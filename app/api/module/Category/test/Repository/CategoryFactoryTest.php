<?php

declare(strict_types=1);

namespace CategoryTest\Repository;

use Category\Repository\CategoryInterface;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class CategoryFactoryTest extends AbstractHttpControllerTestCase
{
    protected function setUp(): void
    {
        $config = require __DIR__ . '/../../../../config/application.config.php';

        $this->setApplicationConfig($config);
        parent::setUp();
    }

    public function testCreateFactorySuccessful()
    {
        $app     = $this->getApplication();
        $sm      = $app->getServiceManager();
        $factory = $sm->get(CategoryInterface::class);

        $this->assertInstanceOf(CategoryInterface::class, $factory);
    }
}
