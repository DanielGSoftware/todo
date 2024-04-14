<?php

namespace Tests\Adapters\Outgoing\Task;

use Domain\Model\Task\Task;
use Domain\Model\Task\TaskRepository;
use PHPUnit\Framework\TestCase;

abstract class TaskRepositoryTestCase extends TestCase
{
    abstract protected function getRepository(): TaskRepository;

    public function test_it_can_store_and_find_a_task_by_id(): void
    {
        $repository = $this->getRepository();

        $task = new Task(
            $repository->nextId(),
            'FooTitle',
            true
        );
        $repository->save($task);

        $task = $repository->getById($task->id());
        self::assertInstanceOf(Task::class, $task);
        self::assertEquals('FooTitle', $task->title());
        self::assertTrue($task->isCompleted());
    }

    public function test_it_returns_null_when_no_task_is_found_by_id(): void
    {
        $repository = $this->getRepository();

        self::assertNull($repository->getById(1));
    }
}
