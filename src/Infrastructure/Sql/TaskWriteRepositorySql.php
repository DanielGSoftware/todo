<?php

namespace Infrastructure\Sql;

use Domain\Model\Task\TaskWrite;
use Domain\Model\Task\TaskWriteRepository;
use PDO;

final readonly class TaskWriteRepositorySql implements TaskWriteRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function nextId(): int
    {
        $statement = $this->pdo->prepare('select max(id) from tasks');
        $statement->execute();

        $id = $statement->fetchColumn();

        return ! $id ? 1 : $id + 1;
    }

    public function getById(int $id): ?TaskWrite
    {
        $statement = $this->pdo->prepare('SELECT * FROM tasks WHERE id = :id');

        $statement->execute([':id' => $id]);

        $task = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($task)) {
            return null;
        }

        return TaskWrite::new(
            $task['id'],
            $task['title'],
        );
    }

    public function save(TaskWrite $task): void
    {
        $statement = $this->pdo->prepare('INSERT INTO tasks (id, title, completed) VALUES (:id, :title, :completed)');

        $statement->execute([
            ':id' => $task->id(),
            ':title' => $task->title(),
            ':completed' => (int) $task->isCompleted()
        ]);
    }

    public function update(TaskWrite $task): void
    {
        $statement = $this->pdo->prepare('UPDATE tasks SET title = :title, completed = :completed WHERE id = :id');

        $statement->execute([
            ':id' => $task->id(),
            ':title' => $task->title(),
            ':completed' => (int) $task->isCompleted()
        ]);
    }
}
