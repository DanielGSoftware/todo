<?php

namespace Tests\Unit\Domain\Model;

use Domain\Model\Task\TaskWrite;
use PHPUnit\Framework\TestCase;

class TaskWriteTest extends TestCase
{
    public function test_title_has_to_be_filled(): void
    {
        $this->expectExceptionMessage("Title can't be an empty string");

        TaskWrite::new(1, '');
    }

    public function test_cannot_complete_a_completed_task(): void
    {
        $this->expectExceptionMessage("Can't complete a task that is already completed.");

        $taskWrite = TaskWrite::reconstitute(1, 'FooTitle', true);

        $taskWrite->complete();
    }
}

