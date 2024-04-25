<?php

namespace Application\Tasks\List;

interface TaskReadRepository
{
    /**
     * @return array<array{
     *       id: int|string,
     *       title: string,
     *       description: string,
     *       completed: bool|int
     *  }>
     */
    public function listAll(): array;
}
