<?php

declare(strict_types=1);

/*
 * This file is part of the slince/sql-to-markdown package.
 *
 * (c) Slince <taosikai@yeah.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slince\SqlToMarkdown;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    const NAME = 'SQL To Markdown';
    const VERSION = '0.0.1';

    const LOGO_TEXT = <<<EOT
 ____   ___  _       _____ ___    _____  _    ____  _     _____ 
/ ___| / _ \| |     |_   _/ _ \  |_   _|/ \  | __ )| |   | ____|
\___ \| | | | |       | || | | |   | | / _ \ |  _ \| |   |  _|  
 ___) | |_| | |___    | || |_| |   | |/ ___ \| |_) | |___| |___ 
|____/ \__\_\_____|   |_| \___/    |_/_/   \_\____/|_____|_____|                                                               
EOT;

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