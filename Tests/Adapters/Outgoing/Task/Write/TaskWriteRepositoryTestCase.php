<?php

namespace Tests\Adapters\Outgoing\Task\Write;

use Domain\Model\Task\TaskWrite;
use Domain\Model\Task\TaskWriteRepository;
use PHPUnit\Framework\TestCase;
use Tests\Builders\TaskBuilder;

abstract class TaskWriteRepositoryTestCase extends TestCase
{
    abstract protected function getRepository(): TaskWriteRepository;

    public function test_it_can_store_and_find_a_write_task_by_id(): void
    {
        $repository = $this->getRepository();
        $id = $repository->nextId();

        $writeModel = TaskWrite::new(
            $id,
            'FooTitle',
        );
        $repository->save($writeModel);

        $writeModel = $repository->getById($writeModel->id());
        self::assertInstanceOf(TaskWrite::class, $writeModel);
        self::assertEquals('FooTitle', $writeModel->title());
        self::assertFalse($writeModel->isCompleted());
    }

    public function test_it_returns_null_when_no_task_is_found_by_id(): void
    {
        $repository = $this->getRepository();

        self::assertNull($repository->getById(999));
    }

    public function test_it_can_delete_a_task(): void
    {
        $repository = $this->getRepository();
        $id = $repository->nextId();

        $writeModel = TaskBuilder::create()
            ->setId($id)
            ->build();

        $repository->save($writeModel);
        $repository->delete($writeModel->id());

        self::assertNull($repository->getById($id));
    }
}
