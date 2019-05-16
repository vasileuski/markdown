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
    public function testTable(array $headings, array $data)
    {
        $result = $this->markdown->table($headings, $data);

        if (count($headings) === 0) {
            $this->assertEmpty($result);
        } else {
            $result = array_values(array_filter(explode(PHP_EOL, $result)));

            $resultHead = $result[0] ?? '';
            $resultHeadCount = substr_count($resultHead, '|') + 1;

            foreach ($headings as $key => $heading) {
                if (!is_string($heading)) {
                    $headings[$key] = '';
                }
            }

            $this->assertSame(implode('|', $headings), $resultHead);

            $resultSeparator = $result[1] ?? '';

            $this->assertSame(implode('|', array_fill(0, $resultHeadCount, '---')), $resultSeparator);

            $resultRows = array_values(array_slice($result, 2));

            foreach ($data as $i => $row) {
                if (!is_array($row)) {
                    unset($data[$i]);
                    continue;
                }

                foreach ($row as $y => $cell) {
                    if (!is_string($cell)) {
                        unset($row[$y]);
                    }
                }
            }

            $data = array_values($data);

            $this->assertCount(count($data), $resultRows);

            foreach ($resultRows as $key => $resultRow) {
                $expectedRow = str_replace(PHP_EOL, '', implode('|', $data[$key]));
                $this->assertSame($expectedRow, $resultRow);
            }
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
        $expected = strip_tags($text);

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
}
