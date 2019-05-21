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
        return new \ArrayIterator([
            [
                [ ], // empty set
                [
                    [ 'Head 1', 'Head 2' ],
                ],
                [
                    [ 'Head 1', 'Head 2' ],
                    [ 'Element 1', 'Element 2', 'Element 3'],
                ],
                [
                    [ 'Head 1', 'Head 2' ],
                    [ 'Element 1', 'Element 2' ],
                ],
                [
                    [ 'Head 1', 'Head 2' ],
                    [ true, false ],
                    [ ['some', 'array'], null ],
                ]
            ]
        ]);
    }
}
