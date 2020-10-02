<?php

declare(strict_types=1);

namespace Category\Repository;

use \Exception;

use Category\Entity;

class CategoryJSONFile implements CategoryInterface
{
    private string $filename;

    public function __construct(string $filename)
    {
        if (! is_readable($filename)) {
            throw new Exception(sprintf(
                'The file `%s` its not readable',
                $filename
            ));
        }

        $this->filename = $filename;
    }

    public function get(int $id): ?Entity\Category
    {
        return new Entity\Category(0);
    }

    public function all(): Entity\CategoryIterator
    {
        return new Entity\CategoryIterator([]);
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function update(int $id, string $name): int
    {
        return 0;
    }

    public function create(string $name): Entity\Category
    {
        return new Entity\Category(0);
    }
}
