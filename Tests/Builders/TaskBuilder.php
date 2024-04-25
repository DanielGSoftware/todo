<?php

namespace Tests\Builders;

use Domain\Model\Task\TaskWrite;

final class TaskBuilder
{
    private int $id = 1;
    private string $title = 'FooTitle';

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

    public function build(): TaskWrite
    {
        return TaskWrite::new(
            id: $this->id,
            title: $this->title,
        );
    }
}
