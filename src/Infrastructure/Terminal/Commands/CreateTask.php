<?php

namespace Infrastructure\Terminal\Commands;

use Application\Tasks\CreateTask\CreateTaskService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTask extends Command
{
    public function __construct(
        private readonly CreateTaskService $createTaskService,
        ?string                            $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('task:create')
            ->setHelp('This command allows you to create a new task.')
            ->setDescription('Create a new task.')
            ->addArgument('title', InputArgument::REQUIRED, 'The title of the task.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->createTaskService->create(
            $input->getArgument('title')
        );

        $output->writeln('Task created!');

        return Command::SUCCESS;
    }
}
