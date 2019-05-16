<?php

/*
 * This file is part of the vasileuski/markdown package
 *
 * (c) Dzmitry Vasileuski <vasileuski_dzmitry@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vasileuski\Markdown;

/**
 * Class Formatter
 * @package Vasileuski\Markdown
 */
class Markdown
{
    /**
     * @return string
     */
    public function divider(): string
    {
        return PHP_EOL . '---' . PHP_EOL;
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function h1(string $text): string
    {
        return PHP_EOL . '# ' . $this->inline($text) . PHP_EOL;
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function h2(string $text): string
    {
        return PHP_EOL . '## ' . $this->inline($text) . PHP_EOL;
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function h3(string $text): string
    {
        return PHP_EOL . '### ' . $this->inline($text) . PHP_EOL;
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function h4(string $text): string
    {
        return PHP_EOL . '#### ' . $this->inline($text) . PHP_EOL;
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function h5(string $text): string
    {
        return PHP_EOL . '##### ' . $this->inline($text) . PHP_EOL;
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function h6(string $text): string
    {
        return PHP_EOL . '###### ' . $this->inline($text) . PHP_EOL;
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function bold(string $text): string
    {
        return '__' . $this->inline($text) . '__';
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function italic(string $text): string
    {
        return '_' . $this->inline($text) . '_';
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function striked(string $text): string
    {
        return '~~' . $this->inline($text) . '~~';
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function quote(string $text): string
    {
        return PHP_EOL . '> ' . $text . PHP_EOL;
    }

    /**
     * @param  string $text
     * @param  bool   $inline
     * @param  string $language
     *
     * @return string
     */
    public function code(string $text, bool $inline = true, string $language = ''): string
    {
        if ($inline) {
            return '`' . $this->inline($text) . '`';
        }

        if ($language) {
            $language = preg_replace('/[^a-z]+/', '', strtolower($language));
        }

        return PHP_EOL . '```' . $language . PHP_EOL . $text . PHP_EOL . '```' . PHP_EOL;
    }

    /**
     * @param  array $items
     * @param  bool  $numeric
     *
     * @return string
     */
    public function list(array $items, bool $numeric = true): string
    {
        if (count($items) === 0) {
            return '';
        }

        if ($numeric) {
            $items = array_values($items);
        }

        array_walk(
            $items,
            function (&$item, $key) use ($numeric) {
                $item = ($numeric ? (($key + 1) . '.') : '-') . ' ' . $this->inline($item);
            }
        );

        return PHP_EOL . implode(PHP_EOL, $items) . PHP_EOL;
    }

    /**
     * @param  array $headings
     * @param  array $data
     *
     * @return string
     */
    public function table(array $headings, array $data): string
    {
        if (!count($headings)) {
            return '';
        }

        foreach ($headings as $key => $heading) {
            $headings[$key] = is_string($heading) ? $this->inline($heading) : '';
        }

        foreach ($data as $i => $row) {
            if (!is_array($row) || count($row) !== count($headings)) {
                unset($data[$i]);
                continue;
            }

            foreach ($row as $y => $cell) {
                $row[$y] = is_string($cell) ? $this->inline($cell) : '';
            }
        }

        $table = '';

        $table .= implode('|', $headings) . PHP_EOL;
        $table .= implode('|', array_fill(0, count($headings), '---')) . PHP_EOL;

        foreach ($data as $row) {
            $table .= implode('|', $row) . PHP_EOL;
        }

        return PHP_EOL . $table . PHP_EOL;
    }

    /**
     * @param  string $text
     * @param  string $href
     *
     * @return string
     */
    public function link(string $text, string $href): string
    {
        return '[' . $this->inline($text) . '](' . $this->inline($href) . ')';
    }

    /**
     * @param string $text
     * @param string $src
     *
     * @return string
     */
    public function image(string $text, string $src): string
    {
        return '!' . $this->link($text, $src);
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function escape(string $text): string
    {
        return preg_replace('/(\\\\|`|\*|_|{|}|\[|\]|\(|\)|#|\+|-|\.|!)/', '\\\\\\1', strip_tags($text));
    }

    /**
     * @param  string $text
     *
     * @return string
     */
    public function inline(string $text): string
    {
        return str_replace(PHP_EOL, '', $text);
    }
}
