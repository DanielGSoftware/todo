<?php

namespace Tests\Adapters\Outgoing\Task;

use Domain\Model\Task\TaskRepository;
use Domain\Model\Task\TaskRepositoryInMemory;

class TaskRepositoryInMemoryTest extends TaskRepositoryTestCase
{
    protected function getRepository(): TaskRepository
    {
        return new TaskRepositoryInMemory();
    }
}
