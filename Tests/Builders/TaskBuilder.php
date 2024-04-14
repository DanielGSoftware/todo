<?php

namespace Tests\Builders;

use Domain\Model\Task\Task;

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

    public function build(): Task
    {
        return new Task(
            id: $this->id,
            title: $this->title,
            completed: $this->completed,
        );
    }
}
