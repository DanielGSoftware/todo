<?php

namespace Domain\Model\Task;

interface TaskWriteRepository
{
    public function nextId(): int;

    public function getById(int $id): ?TaskWrite;

    public function save(TaskWrite $task): void;

    public function update(TaskWrite $task): void;
}
