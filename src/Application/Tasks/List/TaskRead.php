<?php

namespace Application\Tasks\List;

final readonly class TaskRead
{
    private function __construct(
        public int $id,
        public string $title,
        public string $description,
        public bool $completed,
    ) {
    }

    /**
     * @param array{
     *      id: int|string,
     *      title: string,
     *      description: string,
     *      completed: bool|int
     *  } $task
     */
    public static function reconstitute(array $task): self
    {
        return new self(
            $task['id'],
            $task['title'],
            $task['description'],
            (bool) $task['completed'],
        );
    }
}
