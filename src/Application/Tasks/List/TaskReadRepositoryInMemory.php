<?php

namespace Application\Tasks\List;

class TaskReadRepositoryInMemory implements TaskReadRepository
{
    public function listAll(): array
    {
        return [
            TaskRead::reconstitute([
                'id' => 1,
                'title' => 'Task 1',
                'completed' => false,
            ]),
            TaskRead::reconstitute([
                'id' => 2,
                'title' => 'Task 2',
                'completed' => true,
            ]),
            TaskRead::reconstitute([
                'id' => 3,
                'title' => 'Task 3',
                'completed' => false,
            ]),
        ];
    }
}