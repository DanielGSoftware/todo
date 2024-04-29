<?php

namespace Tests\Adapters\Outgoing\Task\Write;

use Application\Tasks\CreateTask\TaskWriteRepositoryInMemory;
use Domain\Model\Task\TaskWriteRepository;

class TaskWriteRepositoryInMemoryTest extends TaskWriteRepositoryTestCase
{
    protected function getRepository(): TaskWriteRepository
    {
        return new TaskWriteRepositoryInMemory();
    }
}
