<?php

namespace Application\Task;

use Domain\Model\Task\TaskWrite;
use Domain\Model\Task\TaskRepository;

class TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository,
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
