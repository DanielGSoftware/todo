<?php

namespace Application;

use Application\Tasks\List\TaskReadRepository;
use Domain\Model\Task\TaskWriteRepository;
use Infrastructure\Sql\TaskReadRepositorySql;
use Infrastructure\Sql\TaskWriteRepositorySql;
use PDO;

class DevelopmentServiceContainer extends ServiceContainer
{
    protected ?PDO $pdo = null;

    public function taskWriteRepository(): TaskWriteRepository
    {
        return new TaskWriteRepositorySql($this->pdo());
    }

    public function taskReadRepository(): TaskReadRepository
    {
        return new TaskReadRepositorySql($this->pdo());
    }

    public function pdo(): PDO
    {
        if (! $this->pdo) {
            $this->pdo = new PDO('mysql:host=127.0.0.1;port=3308;dbname=todo', 'root');
        }

        return $this->pdo;
    }
}
