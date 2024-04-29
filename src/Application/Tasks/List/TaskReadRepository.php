<?php

namespace Application\Tasks\List;

interface TaskReadRepository
{
    /**
     * @return TaskRead[]
     */
    public function listAll(): array;
}
