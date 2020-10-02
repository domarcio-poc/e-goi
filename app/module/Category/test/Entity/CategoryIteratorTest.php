<?php

declare(strict_types=1);

namespace CategoryTest\Entity;

use Category\Entity\Category;
use Category\Entity\CategoryIterator;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

final class CategoryIteratorTest extends AbstractHttpControllerTestCase
{
    protected function setUp(): void
    {
        $config = require __DIR__ . '/../../../../config/application.config.php';

        $this->setApplicationConfig($config);
        parent::setUp();
    }

    public function testIteratorSuccessful()
    {
        $catOne = new Category(10);
        $catOne->setName("foo");
        $catOne->setCreatedAt();
        $catOne->setUpdatedAt();

        $catTwo = new Category(11);
        $catTwo->setName("bar");
        $catTwo->setCreatedAt();
        $catTwo->setUpdatedAt();

        $categories       = [$catOne, $catTwo];
        $categoryIterator = new CategoryIterator($categories);

        $currentCat = $categoryIterator->current();
        $this->assertEquals($categoryIterator->key(), 0);
        $this->assertEquals(10, $currentCat->getID());
        $this->assertEquals("foo", $currentCat->getName());
        $this->assertInstanceOf(\DateTime::class, $currentCat->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $currentCat->getUpdatedAt());

        $categoryIterator->next();
        $currentCat = $categoryIterator->current();
        $this->assertEquals($categoryIterator->key(), 1);
        $this->assertEquals(11, $currentCat->getID());
        $this->assertEquals("bar", $currentCat->getName());
        $this->assertInstanceOf(\DateTime::class, $currentCat->getCreatedAt());
        $this->assertInstanceOf(\DateTime::class, $currentCat->getUpdatedAt());

        $categoryIterator->next();
        $categoryIterator->current();
        $this->assertEquals($categoryIterator->key(), 2);
        $this->assertFalse($categoryIterator->valid());
    }
}
