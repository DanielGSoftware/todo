<?php

namespace Infrastructure\Terminal\Commands;

use Application\Tasks\Complete\CompleteTaskService;
use Application\Tasks\List\RetrieveTasksService;
use Domain\TaskNotFoundException;
use Exception;
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
        try {
            $this->completeTaskService->complete(
                (int) $input->getArgument('id')
            );
        } catch (Exception $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        $output->writeln('Task completed!');

        return Command::SUCCESS;
    }
}
