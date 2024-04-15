<?php

namespace Tests\UseCases\Task;

use Application\Task\TaskService;
use Domain\Model\Task\TaskRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class CreateTaskTest extends TestCase
{
    public function test_it_creates_a_task(): void
    {
        $taskRepository = new TaskRepositoryInMemory();
        $createTaskService = new TaskService($taskRepository);

        $orderId = $createTaskService->create('FooTitle');

        $task = $taskRepository->getReadModelById($orderId);
        self::assertEquals('FooTitle', $task->title());
    }
}
