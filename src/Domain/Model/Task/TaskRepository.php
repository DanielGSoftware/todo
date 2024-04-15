<?php

namespace Domain\Model\Task;

interface TaskRepository
{
    public function nextId(): int;

    public function getWriteModelById(int $id): ?TaskWrite;

    public function getReadModelById(int $id): ?TaskRead;

    public function save(TaskWrite $task): void;
}
