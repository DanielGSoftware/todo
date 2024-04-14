<?php

namespace Application;

use Application\Task\TaskService;
use Domain\Model\Task\TaskRepository;

abstract class ServiceContainer
{
    protected ?TaskRepository $taskRepository = null;
    protected ?TaskService $taskService = null;

    abstract public function taskRepository(): TaskRepository;

    public function taskService(): TaskService
    {
        if (! $this->taskService) {
            $this->taskService = new TaskService($this->taskRepository());
        }

        return $this->taskService;
    }
}
