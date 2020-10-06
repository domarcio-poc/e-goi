<?php

declare(strict_types=1);

namespace Category\Repository;

use Category\Entity;
use Zend\Paginator\Paginator;

interface CategoryInterface
{
    public function get(int $id): ?Entity\Category;

    public function all(?int $offset = 0, ?int $limit = 5, ?string $filterName = ''): Paginator;

    public function delete(int $id): bool;

    public function update(int $id, string $name): int;

    public function create(string $name): Entity\Category;
}
