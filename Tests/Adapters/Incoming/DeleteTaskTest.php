<?php

namespace Tests\Adapters\Incoming;

use Symfony\Component\Console\Tester\CommandTester;
use Tests\BaseTestCase;
use Tests\Builders\TaskBuilder;

class DeleteTaskTest extends BaseTestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();

        $command = $this->container->deleteTaskCommand();
        $this->commandTester = new CommandTester($command);
    }

    public function test_can_delete_a_task(): void
    {
        $task = TaskBuilder::create()->setId(1)->build();
        $this->container->taskWriteRepository()->save($task);

        $this->commandTester->execute(['id' => 1]);

        $this->commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString('Task deleted', $this->commandTester->getDisplay());
        self::assertNull($this->container->taskWriteRepository()->getById(1));
    }

    public function test_cant_delete_a_non_existing_task(): void
    {
        $this->commandTester->execute(['id' => 1]);

        self::assertStringContainsString("Can't delete task: task not found", $this->commandTester->getDisplay());
    }
}
