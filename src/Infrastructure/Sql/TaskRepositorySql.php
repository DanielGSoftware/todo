<?php

namespace Infrastructure\Sql;

use Domain\Model\Task\Task;
use Domain\Model\Task\TaskRepository;
use PDO;

final readonly class TaskRepositorySql implements TaskRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getById(int $id): ?Task
    {
        $statement = $this->pdo->prepare('SELECT * FROM tasks WHERE id = :id');

        $statement->execute([':id' => $id]);

        $task = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($task)) {
            return null;
        }

        return new Task(
            $task['id'],
            $task['title'],
            $task['completed']
        );
    }

    public function nextId(): int
    {
        $statement = $this->pdo->prepare('select max(id) from tasks');
        $statement->execute();

        return $statement->fetchColumn(0) + 1;
    }

    public function save(Task $task): void
    {
        $statement = $this->pdo->prepare('INSERT INTO tasks (id, title, completed) VALUES (:id, :title, :completed)');

        $statement->execute([
            ':id' => $task->id(),
            ':title' => $task->title(),
            ':completed' => (int) $task->isCompleted(),
        ]);
    }
}
