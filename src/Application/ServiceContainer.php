<?php

namespace Application;

use Application\Tasks\CreateTask\CreateTaskService;
use Application\Tasks\CreateTask\TaskWriteRepositoryInMemory;
use Application\Tasks\List\RetrieveTasksService;
use Application\Tasks\List\TaskRead;
use Application\Tasks\List\TaskReadRepository;
use Application\Tasks\List\TaskReadRepositoryInMemory;
use Domain\Model\Task\TaskWriteRepository;
use Infrastructure\Sql\TaskReadRepositorySql;
use Infrastructure\Terminal\Commands\CreateTask;
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

}
