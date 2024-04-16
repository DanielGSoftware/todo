<?php

namespace Tests\Adapters\Incoming;

use Domain\Model\Task\TaskRead;
use Symfony\Component\Console\Tester\CommandTester;
use Tests\BaseTestCase;

class CreateTaskTest extends BaseTestCase
{
    public function test_a_task_can_be_created_through_the_command_line(): void
    {
        $command = $this->container->taskCliCommand();
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'title' => 'Foo'
        ]);
        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Task created', $output);

        $task = $this->container->taskRepository()->getReadModelById(1);
        self::assertInstanceOf(TaskRead::class, $task);
        self::assertSame('Foo', $task->title());
    }

    public function test_title_is_required(): void
    {
        $this->expectExceptionMessage('missing: "title"');

        $command = $this->container->taskCliCommand();
        $commandTester = new CommandTester($command);

        $commandTester->execute([]);
    }
}
