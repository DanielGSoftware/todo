<?php

namespace Domain\Model\Task;

class TaskRepositoryInMemory implements TaskRepository
{
    private array $tasks = [];

    public function getById(int $id): ?Task
    {
        return $this->tasks[$id] ?? null;
    }

    public function nextId(): int
    {
        if(! $this->tasks) {
            return 1;
        }

        return max(array_keys($this->tasks)) + 1;
    }

    public function save(Task $task): void
    {
        $this->tasks[$task->id()] = $task;
    }
}
