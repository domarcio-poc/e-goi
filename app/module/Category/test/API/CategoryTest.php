<?php

declare(strict_types=1);

namespace CategoryTest\Controller;

use Zend\Http\Request;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

final class CategoryTest extends AbstractHttpControllerTestCase
{
    protected function setUp(): void
    {
        $config = require __DIR__ . '/../../../../config/application.config.php';
        $this->setApplicationConfig($config);

        parent::setUp();
    }

    public function testGetListCanBeAccessed()
    {
        $this->dispatch('/category');
        $this->assertResponseStatusCode(200);
    }

    public function testCreateMissingName()
    {
        $this->dispatch('/category', Request::METHOD_POST);
        $this->assertResponseStatusCode(400);
    }

    public function testCreateInvalidName()
    {
        $this->dispatch('/category', Request::METHOD_POST, ['name' => '   ']);
        $this->assertResponseStatusCode(400);
    }

    public function testCreateSuccessful()
    {
        $repository = $this->getMockBuilder(\Category\Repository\CategoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $expected = new \Category\Entity\Category(1);
        $expected->setName('123456');
        $expected->setCreatedAt();
        $expected->setUpdatedAt();

        $repository->expects($this->once())
            ->method('create')
            ->will($this->returnValue($expected));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(\Category\Repository\CategoryInterface::class, $repository);

        $this->dispatch('/category', Request::METHOD_POST, ['name' => '123456']);
        $this->assertResponseStatusCode(200);
    }

    public function testCreateAlreadyExists()
    {
        $repository = $this->getMockBuilder(\Category\Repository\CategoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('create')
            ->willThrowException(new \Exception('XPTO already exists', 409));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(\Category\Repository\CategoryInterface::class, $repository);

        $this->dispatch('/category', Request::METHOD_POST, ['name' => 'XPTO']);
        $this->assertResponseStatusCode(409);
    }

    public function testUpdateSuccessful()
    {
        $repository = $this->getMockBuilder(\Category\Repository\CategoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('update')
            ->will($this->returnValue(1));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(\Category\Repository\CategoryInterface::class, $repository);

        $this->dispatch('/category/1', Request::METHOD_PATCH, ['name' => 'updated']);
        $this->assertResponseStatusCode(204);
    }

    public function testUpdateCategoryNotFound()
    {
        $repository = $this->getMockBuilder(\Category\Repository\CategoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('update')
            ->willThrowException(new \Exception('Category not found', 404));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(\Category\Repository\CategoryInterface::class, $repository);

        $this->dispatch('/category/1', Request::METHOD_PATCH, ['name' => 'any']);
        $this->assertResponseStatusCode(404);
    }

    public function testDeleteSuccessful()
    {
        $repository = $this->getMockBuilder(\Category\Repository\CategoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('delete')
            ->will($this->returnValue(true));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(\Category\Repository\CategoryInterface::class, $repository);

        $this->dispatch('/category/1', Request::METHOD_DELETE);
        $this->assertResponseStatusCode(204);
    }

    public function testDeleteCategoryNotFount()
    {
        $repository = $this->getMockBuilder(\Category\Repository\CategoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $repository->expects($this->once())
            ->method('delete')
            ->willThrowException(new \Exception('Category not found', 404));

        $serviceManager = $this->getApplicationServiceLocator();
        $serviceManager->setAllowOverride(true);
        $serviceManager->setService(\Category\Repository\CategoryInterface::class, $repository);

        $this->dispatch('/category/1', Request::METHOD_DELETE);
        $this->assertResponseStatusCode(404);
    }
}
