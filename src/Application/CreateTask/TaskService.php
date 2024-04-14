<?php

namespace Application\Task;

use Domain\Model\Task\Task;
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

        $task = new Task(
            id: $taskId,
            title: $title,
            completed: false,
        );

        $this->taskRepository->save($task);

        return $taskId;
    }
}
