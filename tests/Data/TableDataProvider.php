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
 * Class TableDataProvider
 * @package Vasileuski\MarkdownTests\Data
 */
class TableDataProvider implements ProviderInterface
{
    /**
     * @return \Iterator
     */
    public static function provide(): \Iterator
    {
        foreach (self::getHeadingOptions() as $headings) {
            foreach (self::getRowOptions() as $rows) {
                yield [ $headings, $rows ];
            }
        }
    }

    /**
     * @return array
     */
    private static function getHeadingOptions(): array
    {
        return [
            [ ], // empty set
            [
                'Head 1',
                'Head 2',
            ],
        ];
    }

    /**
     * @return array
     */
    private static function getRowOptions(): array
    {
        return [
            [ ], // empty set
            [
                [ 'Cell 1 1', 'Cell 1 2'],
                [ 'Cell 2 1', 'Cell 2 2'],
            ],
        ];
    }
}
