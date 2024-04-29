<?php

namespace Domain\Model\Task;

use Assert\Assert;

final class TaskWrite
{
    private function __construct(
        private readonly int $id,
        private string $title,
        private bool $completed,
    ) {
        assert($id > 0, "Id must be greater than 0");
        assert($title !== "", description: "Title can't be an empty string");
        assert($completed === false, description: "Can't create a completed task.");
    }

    public static function new(
        int $id,
        string $title,
    ): self {
        return new self(
            id: $id,
            title: $title,
            completed: false
        );
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

    public function complete(): self
    {
        $this->completed = true;

        return $this;
    }
}
