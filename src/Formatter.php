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
class Formatter
{
    /**
     * @return string
     */
    public function divider(): string
    {
        return '---';
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

        array_walk(
            $headings,
            function ($item) {
                if (!is_string($item)) {
                    return '';
                }

                return $this->inline($item);
            }
        );

        $headings = array_filter($headings);

        array_walk(
            $data,
            function ($item) {
                if (!is_array($item)) {
                    return '';
                }

                array_walk(
                    $item,
                    function ($subitem) {
                        if (!is_string($subitem)) {
                            return '';
                        }

                        return $this->inline($subitem);
                    }
                );

                return array_filter($item);
            }
        );

        array_walk_recursive($data, [$this, 'inline']);

        $table = '';

        $table .= implode('|', $headings) . PHP_EOL;
        $table .= implode('|', array_fill(0, count($headings), '-')) . PHP_EOL;

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
    private function inline(string $text): string
    {
        return str_replace(PHP_EOL, '', $text);
    }
}
