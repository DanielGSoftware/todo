<?php

namespace Infrastructure\Sql;

use Application\Tasks\List\TaskRead;
use Application\Tasks\List\TaskReadRepository;
use PDO;

class TaskReadRepositorySql implements TaskReadRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function listAll(): array
    {
        $statement = $this->pdo->prepare('select * from tasks');
        $statement->execute();

        $records =  $statement->fetchAll(PDO::FETCH_ASSOC);

        $tasks = [];
        foreach ($records as $record) {
            $tasks[] = TaskRead::reconstitute($record);
        }

        return $tasks;
    }
}
