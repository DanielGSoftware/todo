<?php

namespace Domain\Model\Task;

interface TaskRepository
{
    public function nextId(): int;

    public function getById(int $id): ?TaskWrite;

    public function save(TaskWrite $task): void;
}
