<?php

declare(strict_types=1);

namespace Category\Controller;

use Category\Controller\Categories;
use Category\Repository\CategoryInterface as RepoCategoryInterface;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

final class CategoriesFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Categories
    {
        return new Categories($container->get(RepoCategoryInterface::class));
    }
}
