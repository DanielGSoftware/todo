<?php

namespace Application\Tasks\Complete;

use Domain\Model\Task\TaskWriteRepository;

final readonly class CompleteTaskService
{
    public function __construct(private TaskWriteRepository $taskWriteRepository)
    {
    }

    public function complete(int $taskId): void
    {
        $task = $this->taskWriteRepository->getById($taskId);

        $task->complete();

        $this->taskWriteRepository->update($task);

        // We could fire an event here to notify other parts of the system that a task has been completed.
        // That's why we have this service, to encapsulate the logic of completing a task instead of doing this in the command.
    }
}