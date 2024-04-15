<?php

namespace Infrastructure\Sql;

use Domain\Model\Task\TaskRead;
use Domain\Model\Task\TaskWrite;
use Domain\Model\Task\TaskRepository;
use PDO;

final readonly class TaskRepositorySql implements TaskRepository
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

    public function getWriteModelById(int $id): ?TaskWrite
    {
        $statement = $this->pdo->prepare('SELECT * FROM tasks WHERE id = :id');

        $statement->execute([':id' => $id]);

        $task = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($task)) {
            return null;
        }

        return new TaskWrite(
            $task['id'],
            $task['title'],
            $task['completed']
        );
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
        $statement = $this->pdo->prepare('INSERT INTO tasks (id, title, completed) VALUES (:id, :title, :completed)');

        $statement->execute([
            ':id' => $task->id,
            ':title' => $task->title,
            ':completed' => (int) $task->completed
        ]);
    }
}
