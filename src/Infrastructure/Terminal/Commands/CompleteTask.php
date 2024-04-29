<?php

namespace Infrastructure\Terminal\Commands;

use Application\Tasks\Complete\CompleteTaskService;
use Application\Tasks\List\RetrieveTasksService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CompleteTask extends Command
{
    public function __construct(
        private CompleteTaskService $completeTaskService,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('task:complete')
            ->setHelp('This command allows you to complete a task.')
            ->setDescription('This command allows you to complete a task.')
            ->addArgument('id', InputArgument::REQUIRED, 'The id of the task to complete.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->completeTaskService->complete(
            (int) $input->getArgument('id')
        );

        return Command::SUCCESS;
    }
}
