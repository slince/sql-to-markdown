<?php

namespace Slince\SqlToMarkdown\Command;

use Slince\SqlToMarkdown\Exception\FileNotFoundException;
use Slince\SqlToMarkdown\SqlToMarkdown;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends Command
{
    /**
     * @var SqlToMarkdown
     */
    protected $sqlToMarkdown;

    public function __construct(SqlToMarkdown $sqlToMarkdown)
    {
        $this->sqlToMarkdown = $sqlToMarkdown;
        parent::__construct(null);
    }

    protected function configure()
    {
        $this->setName('convert')
            ->setDescription('Convert sql to markdown')
            ->addOption('source', 's', InputOption::VALUE_REQUIRED, 'The source sql file')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'The output md file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $outputFile = $this->generateFilename($input);
        $sourceFile = $input->getOption('source');
        if (!is_file($sourceFile)) {
            throw new FileNotFoundException(sprintf('The file "%s" is not found', $sourceFile));
        }
        $source = file_get_contents($sourceFile);
        $markdown = $this->sqlToMarkdown->convertSqlToMarkdown($source);
        $this->makeFile($outputFile, $markdown);
    }

    protected function makeFile($file, $source)
    {
        @mkdir(dirname($file), 0777, true);
        $result = file_put_contents($file, $source);
        if (false === $result) {
            throw new \RuntimeException('Cannot write to file "%s"', $file);
        }
    }

    protected function generateFilename(InputInterface $input)
    {
        $file = $input->getOption('output');
        if (!$file) {
            $file = getcwd() . '/' . pathinfo($input->getOption('source'), PATHINFO_BASENAME) . '.md';
        }
        return $file;
    }
}