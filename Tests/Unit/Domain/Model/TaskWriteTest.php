<?php

namespace Tests\Unit\Domain\Model;

use Domain\Model\Task\TaskWrite;
use PHPUnit\Framework\TestCase;

class TaskWriteTest extends TestCase
{
    public function test_title_has_to_be_filled(): void
    {
        $this->expectExceptionMessage("Title can't be an empty string");

        new TaskWrite(1, '', false);
    }
}