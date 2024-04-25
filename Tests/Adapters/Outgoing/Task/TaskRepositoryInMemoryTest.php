<?php

namespace Tests\Adapters\Outgoing\Task;

use Application\Tasks\CreateTask\TaskWriteRepositoryInMemory;
use Domain\Model\Task\TaskWriteRepository;

class TaskRepositoryInMemoryTest extends TaskRepositoryTestCase
{
    protected function getRepository(): TaskWriteRepository
    {
        return new TaskWriteRepositoryInMemory();
    }
}
