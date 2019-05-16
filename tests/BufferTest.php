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

use Vasileuski\Markdown\Buffer;

/**
 * Class BufferTest
 * @package Vasileuski\MarkdownTests
 */
class BufferTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Buffer
     */
    protected $buffer;

    /**
     * @return void
     */
    protected function setUp()
    {
        $this->buffer = new Buffer();
    }

    /**
     * @return void
     */
    protected function tearDown()
    {
        $this->buffer->clear();
    }

    /**
     * @return void
     */
    public function testNew()
    {
        $newBuffer = $this->buffer->new();

        $this->assertSame(Buffer::class, get_class($newBuffer));
        $this->assertNotSame(spl_object_hash($this->buffer), $newBuffer);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringsPairDataProvider::provide()
     *
     * @param string $first
     * @param string $second
     *
     * @return void
     */
    public function testAdd(string $first, string $second)
    {
        $result = $this->buffer->add($first, $second);

        $this->assertSame(get_class($result), Buffer::class);
        $this->assertSame($first . $second, $this->buffer->out());
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringsPairDataProvider::provide()
     *
     * @param string $first
     * @param string $second
     *
     * @return void
     */
    public function testClear(string $first, string $second)
    {
        $output = $this->buffer->out();

        $this->assertEmpty($output);

        $output = $this->buffer->add($first, $second)->out(false);

        $this->assertSame($first . $second, $output);

        $output = $this->buffer->clear()->out(false);

        $this->assertEmpty($output);
    }

    /**
     * @dataProvider \Vasileuski\MarkdownTests\Data\StringsPairDataProvider::provide()
     *
     * @param string $first
     * @param string $second
     *
     * @return void
     */
    public function testOut(string $first, string $second)
    {
        $output = $this->buffer->out();

        $this->assertEmpty($output);

        $output = $this->buffer->add($first, $second)->out(false);

        $this->assertSame($first . $second, $output);

        $output = $this->buffer->out();

        $this->assertSame($first . $second, $output);

        $output = $this->buffer->out();

        $this->assertEmpty($output);
    }

    /**
     * @return void
     */
    public function testToString()
    {
        $this->buffer->add('Line');

        $this->assertSame($this->buffer->out(false), (string) $this->buffer);
    }
}
