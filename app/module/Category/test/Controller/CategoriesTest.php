<?php

declare(strict_types=1);

namespace CategoryTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

final class AlbumControllerTest extends AbstractHttpControllerTestCase
{
    protected function setUp(): void
    {
        $config = require __DIR__ . '/../../../../config/application.config.php';

        $this->setApplicationConfig($config);
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/categories');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Category');
        $this->assertControllerName('Category\Controller\Categories');
        $this->assertControllerClass('Categories');
        $this->assertMatchedRouteName('categories');
    }
}
