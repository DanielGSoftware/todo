<?php

namespace Application;

use Application\Task\TaskService;
use Domain\Model\Task\TaskRepository;
use Domain\Model\Task\TaskRepositoryInMemory;
use Infrastructure\Terminal\Commands\CreateTask;

abstract class ServiceContainer
{
    protected ?TaskRepository $taskRepository = null;

    public function taskRepository(): TaskRepository
    {
        if(! $this->taskRepository) {
            $this->taskRepository = new TaskRepositoryInMemory();
        }

        return $this->taskRepository;
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
