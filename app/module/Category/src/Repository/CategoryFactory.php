<?php

declare(strict_types=1);

namespace Category\Repository;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

final class CategoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): CategoryInterface
    {
        $config   = $container->get('config');
        $filename = $config['db']['inmemo']['filename'] ?? '';

        return new CategoryJSONFile($filename);
    }
}
