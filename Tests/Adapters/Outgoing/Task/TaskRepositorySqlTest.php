<?php

namespace Tests\Adapters\Outgoing\Task;

use Domain\Model\Task\TaskRepository;
use Tests\TestServiceContainerWithDatabase;

class TaskRepositorySqlTest extends TaskRepositoryTestCase
{
    protected TestServiceContainerWithDatabase $serviceContainer;

    protected function setUp(): void
    {
        $this->serviceContainer = new TestServiceContainerWithDatabase();

        $pdo = $this->serviceContainer->pdo();
        $pdo->beginTransaction();
    }

    protected function getRepository(): TaskRepository
    {
        return $this->serviceContainer->taskRepository();
    }
}
