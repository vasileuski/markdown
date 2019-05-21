<?php

/*
 * This file is part of the vasileuski/markdown package
 *
 * (c) Dzmitry Vasileuski <vasileuski_dzmitry@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vasileuski\MarkdownTests;

use Vasileuski\Markdown\Markdown;

/**
 * Class MarkdownTest
 * @package Vasileuski\MarkdownTests
 */
class MarkdownTest extends \PHPUnit\Framework\TestCase
{
    const REGEXP_H1 = '/^\n# (.*)\n$/s';
    const REGEXP_H2 = '/^\n## (.*)\n$/s';
    const REGEXP_H3 = '/^\n### (.*)\n$/s';
    const REGEXP_H4 = '/^\n#### (.*)\n$/s';
    const REGEXP_H5 = '/^\n##### (.*)\n$/s';
    const REGEXP_H6 = '/^\n###### (.*)\n$/s';

    const REGEXP_BOLD    = '/^__(.*)__$/s';
    const REGEXP_ITALIC  = '/^_(.*)_$/s';
    const REGEXP_STRIKED = '/^~~(.*)~~$/s';
    const REGEXP_QUOTE   = '/^\n> (.*)\n$/s';

    const REGEXP_LIST_ITEM_NUMERIC = '/^(\d+). (.*)$/s';
    const REGEXP_LIST_ITEM_BULLET = '/^(-) (.*)$/s';

    const REGEXP_CODE = '/^\n```([a-z]*)\n(.*)\n```\n$/s';
    const REGEXP_CODE_INLINE = '/^`(.*)`$/s';

    const REGEXP_LINK  = '/^\[(.*)\]\((.*)\)$/s';
    const REGEXP_IMAGE = '/^!\[(.*)\]\((.*)\)$/s';

    const REGEXP_COMMENT = '/^\[comment\]: # \((.*)\)$/s';

    /**
     * @var \Vasileuski\Markdown\Markdown
     */
    protected $markdown;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->markdown = new Markdown();
    }

    /**
     * @return void
     */
    public function testDivider()
    {
        $result = $this->markdown->divider();

        $this->assertSame(PHP_EOL . '---' . PHP_EOL, $result);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testH1(string $text)
    {
        $result = $this->markdown->h1($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_H1, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testH2(string $text)
    {
        $result = $this->markdown->h2($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_H2, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testH3(string $text)
    {
        $result = $this->markdown->h3($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_H3, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testH4(string $text)
    {
        $result = $this->markdown->h4($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_H4, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testH5(string $text)
    {
        $result = $this->markdown->h5($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_H5, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testH6(string $text)
    {
        $result = $this->markdown->h6($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_H6, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testBold(string $text)
    {
        $result = $this->markdown->bold($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_BOLD, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testItalic(string $text)
    {
        $result = $this->markdown->italic($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_ITALIC, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testStriked(string $text)
    {
        $result = $this->markdown->striked($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_STRIKED, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testQuote(string $text)
    {
        $result = $this->markdown->quote($text);

        $this->assertTrue((bool)preg_match(self::REGEXP_QUOTE, $result, $matches));
        $this->assertSame($text, $matches[1]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\ListDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testList(array $items, bool $numeric)
    {
        $result = $this->markdown->list($items, $numeric);

        if (count($items) === 0) {
            $this->assertEmpty($result);
        } else {
            $resultItems = array_values(array_filter(explode(PHP_EOL, $result)));

            $this->assertCount(count($items), $resultItems);

            foreach ($resultItems as $key => $resultItem) {
                if ($numeric) {
                    $this->assertTrue((bool)preg_match(self::REGEXP_LIST_ITEM_NUMERIC, $resultItem, $matches));
                    $this->assertSame($key + 1, (int)$matches[1]);
                } else {
                    $this->assertTrue((bool)preg_match(self::REGEXP_LIST_ITEM_BULLET, $resultItem, $matches));
                }

                $this->assertSame(str_replace(PHP_EOL, '', $items[$key]), $matches[2]);

                $matches = [];
            }
        }
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\TableDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testTable(array $data)
    {
        if (count($data) === 0) {
            $this->expectException(\InvalidArgumentException::class);
        } else {
            $size = count($data[0]);

            foreach ($data as $row) {
                if (!is_array($row)) {
                    $this->expectException(\InvalidArgumentException::class);
                    break;
                }

                if ($size !== count($row)) {
                    $this->expectException(\InvalidArgumentException::class);
                    break;
                }
            }
        }

        $result = $this->markdown->table($data);

        $parts = array_filter(explode(PHP_EOL, $result));
        $size = substr_count($parts[0], '|') + 1;

        $this->assertSame(count($data), count($parts) - 1);
        $this->assertSame(count($data[0]), $size);
        $this->assertSame(implode('|', array_fill(0, $size, '---')), $data[1]);

        foreach (array_slice(2, count($data) - 1) as $key => $row) {
            $this->assertSame(count($data[$key + 1]), $size);
        }
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\CodeDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testCode(string $text, bool $inline = true, string $language = '')
    {
        $result = $this->markdown->code($text, $inline, $language);

        if ($inline) {
            $this->assertTrue((bool)preg_match(self::REGEXP_CODE_INLINE, $result, $matches));
            $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
        } else {
            $this->assertTrue((bool)preg_match(self::REGEXP_CODE, $result, $matches));
            $this->assertSame(preg_replace('/[^a-z]+/', '', strtolower($language)), $matches[1]);
            $this->assertSame($text, $matches[2]);
        }
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringsPairDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testLink(string $text, string $href)
    {
        $result = $this->markdown->link($text, $href);

        $this->assertTrue((bool)preg_match(self::REGEXP_LINK, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
        $this->assertSame(str_replace(PHP_EOL, '', $href), $matches[2]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringsPairDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testImage(string $text, string $src)
    {
        $result = $this->markdown->image($text, $src);

        $this->assertTrue((bool)preg_match(self::REGEXP_IMAGE, $result, $matches));
        $this->assertSame(str_replace(PHP_EOL, '', $text), $matches[1]);
        $this->assertSame(str_replace(PHP_EOL, '', $src), $matches[2]);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\EscapeDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testEscape(string $text)
    {
        $result   = $this->markdown->escape($text);
        $expected = $text;

        foreach (\Vasileuski\MarkdownTests\Data\EscapeDataProvider::$toEscape as $character) {
            $expected = str_replace($character, '\\' . $character, $expected);
        }

        $this->assertSame($expected, $result);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testInline(string $text)
    {
        $result = $this->markdown->inline($text);

        $this->assertSame(str_replace(PHP_EOL, '', $text), $result);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringDataProvider::provide()
     *
     * @param string $text
     *
     * @return void
     */
    public function testComment(string $text)
    {
        $result = $this->markdown->comment($text);

        if (trim($text)) {
            $this->assertStringStartsWith(PHP_EOL, $result);
            $this->assertStringEndsWith(PHP_EOL, $result);

            $resultLines = array_values(array_filter(explode(PHP_EOL, $result)));
            $expectedLines = array_values(array_filter(explode(PHP_EOL, $text)));

            $this->assertSameSize($expectedLines, $resultLines);

            foreach ($resultLines as $key => $resultLine) {
                $expectedLine = $expectedLines[$key];

                $this->assertTrue((bool)preg_match(self::REGEXP_COMMENT, $resultLine, $matches));
                $this->assertSame($expectedLine, $matches[1]);
            }
        } else {
            $this->assertEmpty($result);
        }
    }
}
