<?php

namespace App\Command;

use App\Domain\News\PullNews\PullNews;
use App\Domain\News\PullNews\PullNewsRequest;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'app:pull-news',
    description: 'Pull news from external sources.',
    hidden: false,
)]
class PullNewsCommand extends Command
{
    public function __construct(
        private PullNews $puller,
        private LoggerInterface $logger
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command pull articles from external sources based on "keyword" and date internal("from", "to")')
            ->addArgument('keyword', InputArgument::REQUIRED, 'User password')
            ->addArgument('from', InputArgument::OPTIONAL, 'from date')
            ->addArgument('to', InputArgument::OPTIONAL, 'to date')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Pulling news ...',
            '============',
            '',
        ]);

        $request = new PullNewsRequest();

        $request->keyword = $input->getArgument('keyword');

        $from = $input->getArgument('from');
        if(!empty($from)){
            $request->from = new \DateTimeImmutable($from);
        } else {
            $request->from = new \DateTimeImmutable('now');
        }

        $to = $input->getArgument('to');
        if(!empty($to)){
            $request->to = new \DateTimeImmutable($to);
        }

        try {
            $this->puller->execute($request);
            $output->writeln([
                'Successfully pulled!',
            ]);
            return Command::SUCCESS;    
        } catch (\Exception $e) {
            $output->writeln([
                'Something went wrong!',
            ]);
            $this->logger->error('Unable to pull news', ['exception' => $e, 'message' => $e->getMessage(), 'trace' => $e->getTrace()]);
            return Command::FAILURE;
        }
        
    }

}
