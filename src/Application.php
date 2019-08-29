<?php

namespace Slince\SqlToMarkdown;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    const NAME = 'SQL To Markdown';
    const VERSION = '0.0.1';

    /**
     * @var SqlToMarkdown
     */
    protected $sqlToMarkdown;

    public function __construct(SqlToMarkdown $sqlToMarkdown = null)
    {
        $this->sqlToMarkdown = $sqlToMarkdown;
        parent::__construct(static::NAME, static::VERSION);
    }

    protected function createSqlToMarkdown()
    {
        return new SqlToMarkdown(new Converter());
    }

    public function getSqlToMarkdown()
    {
        if (null !== $this->sqlToMarkdown) {
            return $this->sqlToMarkdown;
        }
        return $this->sqlToMarkdown = $this->createSqlToMarkdown();
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultCommands()
    {
        return array_merge([
            new Command\ConvertCommand($this->getSqlToMarkdown())
        ], parent::getDefaultCommands());
    }
}