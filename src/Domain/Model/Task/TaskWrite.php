<?php

namespace Domain\Model\Task;

use Assert\Assert;

final class TaskWrite
{
    public function __construct(
        public readonly int $id,
        public string $title,
        public bool $completed,
    ) {
        Assert::that($title)->notEmpty("Title can't be an empty string");
    }
}
