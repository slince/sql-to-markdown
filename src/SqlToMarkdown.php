<?php

namespace Slince\SqlToMarkdown;

use MaddHatter\MarkdownTable\Builder as Table;
use PhpMyAdmin\SqlParser\Parser;
use Slince\SqlToMarkdown\Exception\InvalidDDLException;

class SqlToMarkdown
{
    /**
     * @var ConverterInterface
     */
    protected $converter;

    public function __construct(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Convert ddl to markdown table.
     *
     * @param string $sql
     * @return string
     */
    public function convertSqlToMarkdown($sql)
    {
        $parser = new Parser($sql);
        $schemas = iterator_to_array($this->converter->convert($parser));
        if (0 === count($schemas)) {
            throw new InvalidDDLException('The sql is not a valid ddl');
        }
        return $this->render($schemas);
    }

    /**
     * Render schemas
     *
     * @param Schema[] $schemas
     * @return string
     */
    protected function render($schemas)
    {
        $markdown = '';
        foreach ($schemas as $schema) {
            $markdown .= $this->renderSchema($schema) . PHP_EOL;
        }
        return $markdown;
    }

    /**
     * Render schema to markdown
     * @param Schema $schema
     * @return string
     */
    protected function renderSchema(Schema $schema)
    {
        return <<<EOT
## {$schema->getName()} {$schema->getComment() }

{$this->makeTable($schema)->render()}
EOT;
    }

    protected function makeTable(Schema $schema)
    {
        $table = new Table();
        $table->headers([
            'name',
            'type',
            'length',
            'default',
            'comment'
        ]);
        foreach ($schema->getColumns() as $column) {
            $table->row(array_values($column->toArray()));
        }
        return $table;
    }
}