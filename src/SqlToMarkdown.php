<?php

namespace Slince\SqlToMarkdown;

use MaddHatter\MarkdownTable\Builder as Table;
use PhpMyAdmin\SqlParser\Parser;

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
        return $this->render($this->converter->convert($parser));
    }

    /**
     * Render schema to markdown
     * @param Schema $schema
     * @return string
     */
    protected function render(Schema $schema)
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
            $table->row($column->toArray());
        }
        return $table;
    }
}