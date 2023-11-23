<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Domain\News\PullNews\PullNews;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class PullNewsCommandTest extends KernelTestCase
{
    private CommandTester $commandTester;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        $command = $application->find('app:pull-news');
        $this->commandTester = new CommandTester($command);
    }
    public function testExecute(): void
    {

        $this->commandTester->execute([
            // pass arguments to the helper
            'keyword' => 'test',
        ], []);
        $this->commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $this->commandTester->getDisplay();
        $this->assertStringContainsString('Successfully pulled!', $output);

        // ...
    }
    public function testExecuteFail(): void
    {
        $this->expectException(\Exception::class);
        $this->commandTester->execute([], []);
        $output = $this->commandTester->getDisplay();
    }
}
