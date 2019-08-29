<?php

namespace Slince\SqlToMarkdown;

use PhpMyAdmin\SqlParser\Parser;
use Slince\SqlToMarkdown\Exception\InvalidDDLException;

interface ConverterInterface
{
    /**
     * Convert sql parser to schemas.
     *
     * @param Parser $parser
     * @return Schema[]|\Generator
     * @throws InvalidDDLException
     */
    public function convert(Parser $parser);
}