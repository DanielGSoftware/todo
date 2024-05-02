<?php

namespace Application;

use Application\Tasks\Complete\CompleteTaskService;
use Application\Tasks\CreateTask\CreateTaskService;
use Application\Tasks\CreateTask\TaskWriteRepositoryInMemory;
use Application\Tasks\Delete\DeleteTaskService;
use Application\Tasks\List\RetrieveTasksService;
use Application\Tasks\List\TaskReadRepository;
use Application\Tasks\List\TaskReadRepositoryInMemory;
use Domain\Model\Task\TaskWriteRepository;
use Infrastructure\Terminal\Commands\CompleteTask;
use Infrastructure\Terminal\Commands\CreateTask;
use InfraStructure\Terminal\Commands\DeleteTaskCommand;
use Infrastructure\Terminal\Commands\DisplayTasks;

abstract class ServiceContainer
{
    protected ?TaskWriteRepository $taskWriteRepository = null;
    protected ?TaskReadRepository $taskReadRepository = null;

    public function taskWriteRepository(): TaskWriteRepository
    {
        if(! $this->taskWriteRepository) {
            $this->taskWriteRepository = new TaskWriteRepositoryInMemory();
        }

        return $this->taskWriteRepository;
    }

    public function taskReadRepository(): TaskReadRepository
    {
        if(! $this->taskReadRepository) {
            $this->taskReadRepository = new TaskReadRepositoryInMemory();
        }

        return $this->taskReadRepository;
    }

    public function createTaskService(): CreateTaskService
    {
        return new CreateTaskService($this->taskWriteRepository());
    }

    public function createTaskCommand(): CreateTask
    {
        return new CreateTask($this->createTaskService());
    }

    public function retrieveTasksService(): RetrieveTasksService
    {
        return new RetrieveTasksService($this->taskReadRepository());
    }

    public function displayTasksCommand(): DisplayTasks
    {
        return new DisplayTasks($this->retrieveTasksService());
    }

    public function completeTaskService(): CompleteTaskService
    {
        return new CompleteTaskService($this->taskWriteRepository());
    }

    public function completeTaskCommand(): CompleteTask
    {
        return new CompleteTask($this->completeTaskService());
    }

    public function deleteTaskService(): DeleteTaskService
    {
        return new DeleteTaskService($this->taskWriteRepository());
    }

    public function deleteTaskCommand(): DeleteTaskCommand
    {
        return new DeleteTaskCommand($this->deleteTaskService());
    }
}
