<?php

/*
 * This file is part of the vasileuski/markdown package
 *
 * (c) Dzmitry Vasileuski <vasileuski_dzmitry@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vasileuski\MarkdownTests\Data;

/**
 * Class StringsPairDataProvider
 * @package Vasileuski\MarkdownTests\Data
 */
class EscapeDataProvider implements ProviderInterface
{
    /**
     * @var array
     */
    public static $toEscape = [
        '\\',
        '`',
        '*',
        '_',
        '{',
        '}',
        '[',
        ']',
        '(',
        ')',
        '#',
        '+',
        '-',
        '.',
        '!',
    ];

    /**
     * @var int
     */
    private static $combinationCount = 10;

    /**
     * @var int
     */
    private static $charsInCombination = 5;

    /**
     * @return \Iterator
     */
    public static function provide(): \Iterator
    {
        for ($i = 0; $i < self::$combinationCount; $i++) {
            $combination = '';

            for ($y = 0; $y < self::$charsInCombination; $y++) {
                $combination .= self::$toEscape[random_int(0, count(self::$toEscape) - 1)];
            }

            yield [ $combination ];
        }

        yield [ '' ];
    }
}
