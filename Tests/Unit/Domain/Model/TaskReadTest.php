<?php

namespace Tests\Unit\Domain\Model;

use Domain\Model\Task\TaskRead;
use PHPUnit\Framework\TestCase;

final class TaskReadTest extends TestCase
{
    public function test_title_has_to_be_filled(): void
    {
        $this->expectExceptionMessage("Title can't be an empty string");

        new TaskRead(1, '', false);
    }
}
