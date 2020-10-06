<?php

declare(strict_types=1);

namespace Category\API;

use Category\API\Category;
use Category\Repository\CategoryInterface as RepoCategoryInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

final class CategoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Category
    {
        return new Category($container->get(RepoCategoryInterface::class));
    }
}
