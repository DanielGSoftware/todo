<?php

namespace Application\Tasks\List;

final readonly class RetrieveTasksService
{
    public function __construct(private TaskReadRepository $taskReadRepository)
    {
    }

    /**
     * @return TaskRead[]
     */
    public function listAll(): array
    {
        $taskRecords = $this->taskReadRepository->listAll();

        $taskReads = [];

        foreach ($taskRecords as $task) {
            $taskReads[] = TaskRead::reconstitute($task);
        }

        return $taskReads;
    }
}
