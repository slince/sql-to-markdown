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

use PhpMyAdmin\SqlParser\Components\CreateDefinition;
use PhpMyAdmin\SqlParser\Parser;
use PhpMyAdmin\SqlParser\Statements\CreateStatement;

class Converter implements ConverterInterface
{
    /**
     * {@inheritdoc}
     */
    public function convert(Parser $parser)
    {
        foreach ($parser->statements as $statement) {
            if (!$statement instanceof CreateStatement) {
                continue;
            }
            $schema = $this->convertStatement($statement);
            yield $schema;
        }
    }

    protected function convertStatement(CreateStatement $statement)
    {
        $table = [
            'name' => $statement->name->table,
            'comment' => $statement->entityOptions->has('comment') ?: null,
            'columns' => iterator_to_array($this->convertColumns($statement->fields))
        ];
        return Schema::fromArray($table);
    }

    /**
     * @param CreateDefinition[] $fields
     * @return \Generator
     */
    protected function convertColumns($fields)
    {
        foreach ($fields as $field) {
            if (!$field->name) {
                continue;
            }
            $default =  $field->options->has('default') ?: null;
            $comment = $field->options->has('comment') ?: null;
            $column = [
                'name' => $field->name,
                'type'=> $field->type->name,
                'length' => implode(',', $field->type->parameters),
                'default' => $default ? trim($default, "'") : '',
                'comment' => $comment ? trim($comment, "'") : '',
            ];
            yield $column;
        }
    }
}