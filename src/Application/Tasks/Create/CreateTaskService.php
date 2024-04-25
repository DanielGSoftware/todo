<?php

namespace Application\Tasks\CreateTask;

use Domain\Model\Task\TaskWriteRepository;
use Domain\Model\Task\TaskWrite;

class CreateTaskService
{
    public function __construct(
        private readonly TaskWriteRepository $taskRepository,
    ) {
    }

    public function create(
        string $title,
    ): int {
        $taskId = $this->taskRepository->nextId();

        $task = TaskWrite::new(
            id: $taskId,
            title: $title,
        );

        $this->taskRepository->save($task);

        return $taskId;
    }
}
