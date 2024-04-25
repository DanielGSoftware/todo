<?php

namespace Infrastructure\Terminal\Commands;

use Application\Tasks\List\RetrieveTasksService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayTasks extends Command
{
    public function __construct(
        private readonly RetrieveTasksService $retrieveTasksService,
        ?string $name = null
    ) {
        parent::__construct($name);
    }


    protected function configure(): void
    {
        $this->setName('task:list-all')
            ->setHelp('This command allows you to list all tasks.')
            ->setDescription('List all tasks.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $tasks = $this->retrieveTasksService->listAll();

        foreach ($tasks as $task) {
            $output->writeln("Task ID: {$task->id}");
            $output->writeln("Task Title: {$task->title}");
            $output->writeln("Task Description: {$task->description}");
            $output->writeln("Task Completed: " . ($task->completed ? 'Yes' : 'No'));
            $output->writeln("\n");
        }

        return Command::SUCCESS;
    }
}
