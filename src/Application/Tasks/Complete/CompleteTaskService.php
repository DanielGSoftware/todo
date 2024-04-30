<?php

namespace Application\Tasks\Complete;

use Domain\Model\Task\TaskWriteRepository;
use Domain\TaskNotFoundException;

final readonly class CompleteTaskService
{
    public function __construct(private TaskWriteRepository $taskWriteRepository)
    {
    }

    public function complete(int $taskId): void
    {
        $task = $this->taskWriteRepository->getById($taskId);

        if(! $task) {
            throw new TaskNotFoundException("Task with id $taskId not found.");
        }

        $task->complete();

        $this->taskWriteRepository->update($task);
    }
}
