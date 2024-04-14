<?php

namespace Tests\UseCases\Task;

use Application\Task\TaskService;
use Domain\Model\Task\TaskRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class CreateTaskTest extends TestCase
{
    public function test_it_creates_a_task(): void
    {
        // Arrange
        $taskRepository = new TaskRepositoryInMemory();
        $createTaskService = new TaskService($taskRepository);

        // Act
        $orderId = $createTaskService->create('FooTitle');

        // Assert
        $task = $taskRepository->getById($orderId);
        self::assertEquals('FooTitle', $task->title());
    }
}
