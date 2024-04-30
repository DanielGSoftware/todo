<?php

namespace Tests\Builders;

use Domain\Model\Task\TaskWrite;

final class TaskBuilder
{
    private int $id = 1;
    private string $title = 'FooTitle';
    private bool $completed = false;

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function withTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function completed(bool $completed = true): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function build(): TaskWrite
    {
        return TaskWrite::reconstitute(
            id: $this->id,
            title: $this->title,
            completed: $this->completed,
        );
    }

    public function setId(int $int): self
    {
        $this->id = $int;

        return $this;
    }
}