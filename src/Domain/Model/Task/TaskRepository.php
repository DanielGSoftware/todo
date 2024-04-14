<?php

namespace Domain\Model\Task;

interface TaskRepository
{
    public function getById(int $id): ?Task;

    public function nextId(): int;

    public function save(Task $task): void;
}
