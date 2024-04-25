<?php

namespace Application\Tasks\List;

class TaskReadRepositoryInMemory implements TaskReadRepository
{
    public function listAll(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Task 1',
                'description' => 'Description of Task 1',
                'completed' => false,
            ],
            [
                'id' => 2,
                'title' => 'Task 2',
                'description' => 'Description of Task 2',
                'completed' => true,
            ],
            [
                'id' => 3,
                'title' => 'Task 3',
                'description' => 'Description of Task 3',
                'completed' => false,
            ],
        ];
    }
}