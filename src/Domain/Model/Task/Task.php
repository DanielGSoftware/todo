<?php

namespace Domain\Model\Task;

use Assert\Assert;

final readonly class Task
{
    public function __construct(
        private int $id,
        private string $title,
        private bool $completed,
    ) {
        Assert::that($title)->notEmpty("Title can't be an empty string");
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }
}
