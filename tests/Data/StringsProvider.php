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
 * Class StringsProvider
 * @package Vasileuski\MarkdownTests\Data
 */
class StringsProvider implements ProviderInterface
{
    /**
     * @return \Iterator
     */
    public static function provide(): \Iterator
    {
        return new \ArrayIterator([
            '',
            ' ',
            'Simple String',
            implode(PHP_EOL, ['String', 'With', 'EOL']),
            '<b>String with HTML tag</b>',
            'http://some/sample/of/url',
        ]);
    }
}
