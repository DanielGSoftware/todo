<?php

namespace Application;

use Application\Task\TaskService;
use Domain\Model\Task\TaskRepository;
use Domain\Model\Task\TaskRepositoryInMemory;
use Infrastructure\Terminal\Commands\CreateTask;

abstract class ServiceContainer
{
    public function taskRepository(): TaskRepository
    {
        return new TaskRepositoryInMemory();
    }

    public function taskService(): TaskService
    {
        return new TaskService($this->taskRepository());
    }

    public function taskCliCommand(): CreateTask
    {
        return new CreateTask($this->taskService());
    }
}
