<?php

declare(strict_types=1);

namespace CategoryTest\Repository;

use Category\Entity\Category;
use Category\Repository\CategoryJSONFile;
use PHPUnit\Framework\TestCase;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

class CategoryJSONFileTest extends TestCase
{
    public function testGetSuccessfull()
    {
        $expected = new Category(1001);
        $expected->setName('foo');
        $expected->setCreatedAt();
        $expected->setUpdatedAt();

        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('get')
            ->with(1001)
            ->willReturn($expected);

        $result = $repository->get(1001);
        $this->assertEquals(1001, $result->getID());
        $this->assertEquals('foo', $result->getName());
    }

    public function testGetUnsuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('get')
            ->with(1001)
            ->willThrowException(new \Exception('Category not found'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Category not found');
        $repository->get(1001);
    }

    public function testAllSuccessfull()
    {
        $expected = new Category(1001);
        $expected->setName('foo');
        $expected->setCreatedAt();
        $expected->setUpdatedAt();

        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('all')
            ->willReturn(new Paginator(new ArrayAdapter([$expected])));

        $result = $repository->all();
        $this->assertEquals(1, $result->count());

        $currentCat = $result->getCurrentItems()['0'];
        $this->assertEquals(1001, $currentCat->getID());
        $this->assertEquals('foo', $currentCat->getName());
    }

    public function testAllUnuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('all')
            ->willReturn(new Paginator(new ArrayAdapter([])));

        $result = $repository->all();
        $this->assertEquals(0, $result->count());
    }

    public function testDeleteSuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('delete')
            ->with(1001)
            ->willReturn(true);

        $result = $repository->delete(1001);
        $this->assertTrue($result);
    }

    public function testDeleteUnsuccessful()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('delete')
            ->with(1001)
            ->willThrowException(new \Exception('Category not found'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Category not found');
        $repository->delete(1001);
    }

    public function testUpdateSuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(1001, 'XPTO')
            ->willReturn(1);

        $result = $repository->update(1001, 'XPTO');
        $this->assertEquals(1, $result);
    }

    public function testUpdateUnsuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(1001, 'XPTO')
            ->willThrowException(new \Exception('Category not found'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Category not found');
        $repository->update(1001, 'XPTO');
    }

    public function testCreateSuccessfull()
    {
        $expected = new Category(1);
        $expected->setName('XPTO');
        $expected->setCreatedAt();
        $expected->setUpdatedAt();

        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('create')
            ->with('XPTO')
            ->willReturn($expected);

        $result = $repository->create('XPTO');
        $this->assertEquals($result->getID(), 1);
    }

    public function testCreateUnsuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('create')
            ->with('XPTO')
            ->willThrowException(new \Exception('XPTO category already exists'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('XPTO category already exists');
        $repository->create('XPTO');
    }
}
