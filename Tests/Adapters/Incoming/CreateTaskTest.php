<?php

namespace Tests\Adapters\Incoming;

use Application\Task\TaskService;
use Infrastructure\Terminal\Commands\CreateTask;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateTaskTest extends TestCase
{
    public function test_a_task_can_be_created_through_the_command_line(): void
    {
        // Arrange
        $createTaskServiceMock = $this->createMock(TaskService::class);
        $createTaskServiceMock
            ->expects($this->once())
            ->method('create')
            ->with('Foo')
            ->willReturn(1);
        $command = new CreateTask($createTaskServiceMock);
        $commandTester = new CommandTester($command);

        // Act
        $response = $commandTester->execute([
            'title' => 'Foo'
        ]);
    }
}
