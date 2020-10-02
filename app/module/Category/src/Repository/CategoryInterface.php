<?php

declare(strict_types=1);

namespace Category\Repository;

use Category\Entity;

interface CategoryInterface
{
    public function get(int $id): ?Entity\Category;

    public function all(): Entity\CategoryIterator;

    public function delete(int $id): bool;

    public function update(int $id, string $name): int;

    public function create(string $name): Entity\Category;
}
