<?php

namespace Tests\Unit\Domain\Model;

use Domain\Model\Task\Task;
use PHPUnit\Framework\TestCase;

final class TaskTest extends TestCase
{
    public function test_title_has_to_be_filled(): void
    {
        $this->expectExceptionMessage("Title can't be an empty string");

        new Task(1, '', false);
    }
}
