<?php

namespace Tests\UseCases\Task;

use Application\Task\TaskService;
use Domain\Model\Task\TaskRead;
use Domain\Model\Task\TaskRepositoryInMemory;
use Domain\Model\Task\TaskWrite;
use Tests\BaseTestCase;

class CreateTaskTest extends BaseTestCase
{
    public function test_it_creates_a_task(): void
    {
        $orderId = $this
            ->container
            ->taskService()
            ->create('FooTitle');

        $task = $this->container->taskRepository()->getById($orderId);
        self::assertInstanceOf(TaskWrite::class, $task);
        self::assertEquals('FooTitle', $task->title());
    }
}
