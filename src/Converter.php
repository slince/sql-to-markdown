<?php

namespace Slince\SqlToMarkdown;

use PhpMyAdmin\SqlParser\Parser;
use PhpMyAdmin\SqlParser\Statements\CreateStatement;

class Converter implements ConverterInterface
{
    /**
     * {@inheritdoc}
     */
    public function convert(Parser $parser)
    {
        $statement = $parser->statements[0];
        if (!$statement instanceof CreateStatement) {
            throw new InvalidDDLException();
        }
        $this->convertStatement($statement);
    }

    protected function convertStatement(CreateStatement $statement)
    {
        $statement->fields = [];
        $table = [
            'name' => $statement->name->table,
            'comment' => $statement->entityOptions->has('comment') ?: null,
            'columns' => iterator_to_array($this->convertColumns($statement->fields))
        ];
        return Schema::fromArray($table);
    }

    protected function convertColumns($fields)
    {
        foreach ($fields as $field) {
            $default =  $field->options->has('default') ?: null;
            $comment = $field->options->has('comment') ?: null;
            $column = [
                'name' => $field->name,
                'type'=> $field->type->name,
                'length' => $field->type->parameters[0],
                'default' => $default ? trim($default, "'") : '',
                'comment' => $comment ? trim($comment, "'") : '',
            ];
            yield $column;
        }
    }
}