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
 * Class StringDataProvider
 * @package Vasileuski\MarkdownTests\Data
 */
class StringDataProvider implements ProviderInterface
{
    /**
     * @return \Iterator
     */
    public static function provide(): \Iterator
    {
        foreach (StringsProvider::provide() as $string) {
            yield [ $string ];
        }
    }
}
