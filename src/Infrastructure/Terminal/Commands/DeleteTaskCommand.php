<?php

namespace InfraStructure\Terminal\Commands;

use Application\Tasks\Delete\DeleteTaskService;
use Domain\TaskNotFoundException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteTaskCommand extends Command
{
    public function __construct(
        private readonly DeleteTaskService $deleteTaskService,
        ?string                            $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('task:delete')
            ->setHelp('This command allows you to delete a task.')
            ->setDescription('This command allows you to delete a task.')
            ->addArgument('id', InputArgument::REQUIRED, 'The id of the task to delete.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->deleteTaskService->delete(
                (int) $input->getArgument('id')
            );
        } catch (TaskNotFoundException $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        $output->writeln('Task deleted!');

        return Command::SUCCESS;
    }
}
