<?php

namespace Application\Tasks\List;

final readonly class RetrieveTasksService
{
    public function __construct(private TaskReadRepository $taskReadRepository)
    {
    }

    public function listAll(): array
    {
        return $this->taskReadRepository->listAll();
    }
}
