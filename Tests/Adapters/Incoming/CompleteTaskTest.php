<?php

namespace Tests\Adapters\Incoming;

use Symfony\Component\Console\Tester\CommandTester;
use Tests\BaseTestCase;
use Tests\Builders\TaskBuilder;

class CompleteTaskTest extends BaseTestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();

        $command = $this->container->completeTaskCommand();
        $this->commandTester = new CommandTester($command);
    }

    public function test_can_complete_a_task(): void
    {
        $task = TaskBuilder::create()->setId(1)->build();
        $this->container->taskWriteRepository()->save($task);

        $this->commandTester->execute(['id' => 1]);

        $this->commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString('Task completed!', $this->commandTester->getDisplay());
    }

    public function test_an_id_is_required(): void
    {
        $this->expectExceptionMessage('Not enough arguments (missing: "id").');

        $this->commandTester->execute([]);
    }

    public function test_fails_when_task_is_not_found(): void
    {
        $this->commandTester->execute([
            'id' => 12345
        ]);

        self::assertStringContainsString('Task with id 12345 not found.', $this->commandTester->getDisplay());
    }

    public function test_cant_complete_an_already_completed_task(): void
    {
        $task = TaskBuilder::create()
            ->setId(1)
            ->completed()
            ->build();
        $this->container->taskWriteRepository()->save($task);

        $this->commandTester->execute(['id' => 1]);

        self::assertStringContainsString("Can't complete a task that is already completed.", $this->commandTester->getDisplay());
    }
}
