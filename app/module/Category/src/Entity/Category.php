<?php

declare(strict_types=1);

namespace Category\Entity;

use \DateTime;

class Category
{
    private int $id;

    private string $name;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTime('now');
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTime('now');
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
