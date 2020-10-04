<?php

declare(strict_types=1);

namespace Category\Repository;

use Category\Entity;
use DateTime;
use Exception;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class CategoryJSONFile implements CategoryInterface
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        if (! is_writable($this->filename)) {
            throw new Exception(sprintf(
                'The file `%s` does not writable',
                $filename,
            ));
        }
    }

    public function get(int $id): ?Entity\Category
    {
        $categories = json_decode(file_get_contents($this->filename), true);

        if (empty($categories)) {
            $categories = [];
        }

        foreach ($categories as $category) {
            if ($id === $category['id']) {
                $c = new Entity\Category($id);
                $c->setName($category['name']);
                $c->setCreatedAt(DateTime::createFromFormat(DateTime::RFC3339_EXTENDED, $category['created_at']));
                $c->setUpdatedAt(DateTime::createFromFormat(DateTime::RFC3339_EXTENDED, $category['updated_at']));
                return $c;
            }
        }

        throw new Exception('Category not found', 404);
    }

    public function all(?int $offset = 0, ?int $limit = 5): Paginator
    {
        $categories = json_decode(file_get_contents($this->filename), true);
        if (empty($categories)) {
            $categories = [];
        }

        $paginator = new Paginator(new ArrayAdapter($categories));
        $paginator->setCurrentPageNumber($offset);
        $paginator->setItemCountPerPage($limit);

        return $paginator;
    }

    public function delete(int $id): bool
    {
        $categories = json_decode(file_get_contents($this->filename), true);
        $found      = false;

        if (empty($categories)) {
            $categories = [];
        }

        foreach ($categories as $key => $category) {
            if ($id === $category['id']) {
                unset($categories[$key]);
                $found = true;
            }
        }

        if (! $found) {
            throw new Exception('Category not found', 404);
        }

        $created = file_put_contents($this->filename, json_encode($categories));
        if ($created === false) {
            throw new Exception('Unknown error on create category', 500);
        }

        return true;
    }

    public function update(int $id, string $name): int
    {
        $categories = json_decode(file_get_contents($this->filename), true);
        $found      = false;

        if (empty($categories)) {
            $categories = [];
        }

        foreach ($categories as $key => &$category) {
            if ($id !== $category['id'] && $name === $category['name']) {
                throw new Exception(sprintf('%s category already exists', $name), 409);
            }

            if ($id === $category['id']) {
                if ($name === $category['name']) {
                    return 0;
                }

                $category['name']       = $name;
                $category['updated_at'] = (new DateTime('now'))->format(DateTime::RFC3339_EXTENDED);
                $found = true;
                break;
            }
        }

        if (! $found) {
            throw new Exception('Category not found', 404);
        }

        $created = file_put_contents($this->filename, json_encode($categories));
        if ($created === false) {
            throw new Exception('Unknown error on create category', 500);
        }

        return 1;
    }

    public function create(string $name): Entity\Category
    {
        $categories = json_decode(file_get_contents($this->filename), true);

        if (empty($categories)) {
            $categories = [];
        }

        foreach ($categories as $category) {
            if ($name === $category['name']) {
                throw new Exception(sprintf('%s category already exists', $name), 409);
            }
        }

        $lastCategory = end($categories);
        $nextID       = empty($lastCategory) ? 1 : $lastCategory['id'] + 1;

        $category = new Entity\Category($nextID);
        $category->setName($name);
        $category->setCreatedAt();
        $category->setUpdatedAt();

        $categories[] = $category->getArrayCopy();

        $created = file_put_contents($this->filename, json_encode($categories));
        if ($created === false) {
            throw new Exception('Unknown error on create category', 500);
        }

        return $category;
    }
}
