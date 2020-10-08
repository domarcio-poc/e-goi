<?php

declare(strict_types=1);

namespace Category\Entity;

use DateTime;

final class Category
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

    public function setCreatedAt(?DateTime $createdAt = null): void
    {
        if ($createdAt === null) {
            $createdAt = new DateTime('now');
        }
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt = null): void
    {
        if ($updatedAt === null) {
            $updatedAt = new DateTime('now');
        }
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getArrayCopy(): array
    {
        return [
            'id'         => $this->getID(),
            'name'       => $this->getName(),
            'created_at' => $this->getCreatedAt()->format(DateTime::RFC3339_EXTENDED),
            'updated_at' => $this->getUpdatedAt()->format(DateTime::RFC3339_EXTENDED),
        ];
    }
}
