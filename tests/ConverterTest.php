<?php

namespace Slince\SqlToMarkdown\Tests;

use PhpMyAdmin\SqlParser\Parser;
use PHPUnit\Framework\TestCase;
use Slince\SqlToMarkdown\Converter;

class ConverterTest extends TestCase
{
    public function testConvert()
    {
        $sql = file_get_contents(__DIR__ . '/Fixtures/foo.sql');
        $parser = new Parser($sql);
        $converter = new Converter();
        $converter->convert($parser);
    }
}