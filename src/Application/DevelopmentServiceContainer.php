<?php

namespace Application;

use Domain\Model\Task\TaskRepository;
use Infrastructure\Sql\TaskRepositorySql;
use PDO;

class DevelopmentServiceContainer extends ServiceContainer
{
    protected ?PDO $pdo = null;

    public function taskRepository(): TaskRepository
    {
        return new TaskRepositorySql($this->pdo());
    }

    public function pdo(): PDO
    {
        if (! $this->pdo) {
            $this->pdo = new PDO('mysql:host=127.0.0.1;port=3308;dbname=todo', 'root');
        }

        return $this->pdo;
    }
}
