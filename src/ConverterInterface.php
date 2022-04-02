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