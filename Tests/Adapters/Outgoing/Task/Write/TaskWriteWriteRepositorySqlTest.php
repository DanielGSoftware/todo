<?php

namespace Tests\Adapters\Outgoing\Task\Write;

use Domain\Model\Task\TaskWriteRepository;
use Tests\TestServiceContainerWithDatabase;

class TaskWriteWriteRepositorySqlTest extends TaskWriteRepositoryTestCase
{
    protected TestServiceContainerWithDatabase $serviceContainer;

    protected function setUp(): void
    {
        $this->serviceContainer = new TestServiceContainerWithDatabase();

        $pdo = $this->serviceContainer->pdo();
        $pdo->beginTransaction();
    }

    protected function getRepository(): TaskWriteRepository
    {
        return $this->serviceContainer->taskWriteRepository();
    }
}
