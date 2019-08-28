<?php

namespace Slince\SqlToMarkdown;

use PhpMyAdmin\SqlParser\Parser;

interface ConverterInterface
{
    /**
     * Convert sql parser to schema.
     *
     * @param Parser $parser
     * @return Schema
     * @throws InvalidDDLException
     */
    public function convert(Parser $parser);
}