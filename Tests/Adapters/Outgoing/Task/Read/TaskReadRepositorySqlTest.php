<?php

namespace Tests\Adapters\Outgoing\Task\Read;

use Tests\BaseTestCase;
use Tests\Builders\TaskBuilder;
use Tests\TestServiceContainerWithDatabase;

class TaskReadRepositorySqlTest extends BaseTestCase
{
    protected TestServiceContainerWithDatabase $serviceContainer;

    protected function setUp(): void
    {
        $this->serviceContainer = new TestServiceContainerWithDatabase();

        $pdo = $this->serviceContainer->pdo();
        $pdo->beginTransaction();
        $pdo->exec('TRUNCATE TABLE tasks');
    }

    public function test_lists_all_tasks(): void
    {
        $task = TaskBuilder::create()->build();
        $taskWriteRepository = $this->serviceContainer->taskWriteRepository();
        $taskWriteRepository->save($task);

        $tasks = $this->serviceContainer->taskReadRepository()->listAll();

        $task = $tasks[0];
        self::assertCount(1, $tasks);
    }
}