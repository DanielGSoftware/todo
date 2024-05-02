<?php

namespace Domain\Model\Task;

use DomainException;

final class TaskWrite
{
    private function __construct(
        private readonly int $id,
        private string $title,
        private bool $completed,
    ) {
        assert($id > 0, "Id must be greater than 0");
        assert($title !== "", description: "Title can't be an empty string");
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

    public static function reconstitute(
        int $id,
        string $title,
        bool $completed,
    ): self {
        return new self(
            id: $id,
            title: $title,
            completed: $completed
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
        if($this->completed) {
            throw new DomainException("Can't complete a task that is already completed.");
        }

        $this->completed = true;

        return $this;
    }
}
