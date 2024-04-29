<?php

namespace Tests\UseCases\Task;

use Domain\Model\Task\TaskRead;
use Domain\Model\Task\TaskWrite;
use Tests\BaseTestCase;

class CreateTaskTest extends BaseTestCase
{
    public function test_it_creates_a_task(): void
    {
        $orderId = $this
            ->container
            ->createTaskService()
            ->create('FooTitle');

        $task = $this->container->taskWriteRepository()->getById($orderId);
        self::assertInstanceOf(TaskWrite::class, $task);
        self::assertEquals('FooTitle', $task->title());
    }
}
