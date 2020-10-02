<?php

declare(strict_types=1);

namespace CategoryTest\Repository;

use Category\Entity\Category;
use Category\Entity\CategoryIterator;
use Category\Repository\CategoryJSONFile;
use PHPUnit\Framework\TestCase;

final class CategoryJSONFileTest extends TestCase
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
            ->willReturn(null);

        $result = $repository->get(1001);
        $this->assertNull($result);
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
            ->willReturn(new CategoryIterator([$expected]));

        $result = $repository->all();
        $this->assertCount(1, $result);

        $currentCat = $result->current();
        $this->assertEquals(1001, $currentCat->getID());
        $this->assertEquals('foo', $currentCat->getName());
    }

    public function testAllUnuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('all')
            ->willReturn(new CategoryIterator([]));

        $result = $repository->all();
        $this->assertCount(0, $result);

        $currentCat = $result->current();
        $this->assertNull($currentCat);
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

    public function testDeleteUnsuccessfull()
    {
        $repository = $this->createMock(CategoryJSONFile::class);
        $repository->expects($this->once())
            ->method('delete')
            ->with(1001)
            ->willReturn(false);

        $result = $repository->delete(1001);
        $this->assertFalse($result);
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
            ->willReturn(0);

        $result = $repository->update(1001, 'XPTO');
        $this->assertEquals(0, $result);
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
            ->willThrowException(new \Exception("XPTO category already exists"));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("XPTO category already exists");
        $repository->create('XPTO');
    }
}
