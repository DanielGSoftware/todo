<?php

namespace Tests;

use Application\ServiceContainer;
use Application\Tasks\List\TaskReadRepository;
use Domain\Model\Task\TaskWriteRepository;
use Infrastructure\Sql\TaskReadRepositorySql;
use Infrastructure\Sql\TaskWriteRepositorySql;
use PDO;

class TestServiceContainerWithDatabase extends ServiceContainer
{
    protected ?PDO $pdo = null;

    public function taskWriteRepository(): TaskWriteRepository
    {
        return new TaskWriteRepositorySql($this->pdo());
    }

    public function taskReadRepository(): TaskReadRepository
    {
        return new TaskReadRepositorySql($this->pdo);
    }

    public function pdo(): PDO
    {
        if (! $this->pdo) {
            $this->pdo = new PDO('mysql:host=127.0.0.1;port=3308;dbname=todo_test', 'root');
        }

        return $this->pdo;
    }
}
