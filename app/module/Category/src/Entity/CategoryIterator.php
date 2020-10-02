<?php

declare(strict_types=1);

namespace Category\Entity;

use \Iterator;

class CategoryIterator implements Iterator
{
    private int $cursor = 0;
    private array $categories = [];

    public function __construct(array $categories)
    {
        $this->cursor = 0;
        $this->categories = $categories;
    }

    public function rewind(): void
    {
        $this->cursor = 0;
    }

    public function current(): ?Category
    {
        return $this->categories[$this->cursor] ?? null;
    }

    public function key(): int
    {
        return $this->cursor;
    }

    public function next(): void
    {
        ++$this->cursor;
    }

    public function valid(): bool
    {
        return isset($this->categories[$this->cursor]);
    }
}
