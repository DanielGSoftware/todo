<?php

namespace Application\Tasks\Delete;

use Domain\Model\Task\TaskWriteRepository;
use Domain\TaskNotFoundException;

final readonly class DeleteTaskService
{
    public function __construct(private TaskWriteRepository $taskWriteRepository)
    {
    }

    public function delete(int $taskId): void
    {
        $task = $this->taskWriteRepository->getById($taskId);

        if (! $task) {
            throw new TaskNotFoundException("Can't delete task: task not found");
        }

        $this->taskWriteRepository->delete($taskId);
    }
}
