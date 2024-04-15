<?php

namespace Tests\Adapters\Outgoing\Task;

use Domain\Model\Task\TaskRead;
use Domain\Model\Task\TaskWrite;
use Domain\Model\Task\TaskRepository;
use PHPUnit\Framework\TestCase;

abstract class TaskRepositoryTestCase extends TestCase
{
    abstract protected function getRepository(): TaskRepository;

    public function test_it_can_store_and_find_a_write_and_read_task_by_id(): void
    {
        $repository = $this->getRepository();
        $id = $repository->nextId();

        $writeModel = new TaskWrite(
            $id,
            'FooTitle',
            true
        );
        $repository->save($writeModel);

        $writeModel = $repository->getWriteModelById($writeModel->id);
        self::assertInstanceOf(TaskWrite::class, $writeModel);
        self::assertEquals('FooTitle', $writeModel->title);
        self::assertTrue($writeModel->completed);

        $readModel = $repository->getReadModelById($id);
        self::assertInstanceOf(TaskRead::class, $readModel);
        self::assertEquals('FooTitle', $readModel->title());
        self::assertTrue($readModel->isCompleted());
    }

    public function test_it_returns_null_when_no_task_is_found_by_id(): void
    {
        $repository = $this->getRepository();

        self::assertNull($repository->getWriteModelById(1));
    }
}
