<?php

namespace Application\Tasks\CreateTask;

use Domain\Model\Task\TaskWrite;
use Domain\Model\Task\TaskWriteRepository;

class TaskWriteRepositoryInMemory implements TaskWriteRepository
{
    private array $tasks = [];

    public function nextId(): int
    {
        if(empty($this->tasks)) {
            return 1;
        }

        return max(array_keys($this->tasks)) + 1;
    }

    public function getById(int $id): ?TaskWrite
    {
        return $this->tasks[$id] ?? null;
    }

    public function save(TaskWrite $task): void
    {
        $this->tasks[$task->id()] = $task;
    }
}
