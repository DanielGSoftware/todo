<?php

namespace Domain\Model\Task;

class TaskRepositoryInMemory implements TaskRepository
{
    private array $tasks = [];

    public function nextId(): int
    {
        if(empty($this->tasks)) {
            return 1;
        }

        return max(array_keys($this->tasks)) + 1;
    }

    public function getWriteModelById(int $id): ?TaskWrite
    {
        return $this->tasks[$id] ?? null;
    }

    public function getReadModelById(int $id): ?TaskRead
    {
        $task = $this->getWriteModelById($id);

        return $task ? new TaskRead(
            $task->id,
            $task->title,
            $task->completed
        ) : null;
    }

    public function save(TaskWrite $task): void
    {
        $this->tasks[$task->id] = $task;
    }
}
