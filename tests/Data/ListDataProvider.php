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
 * Class ListDataProvider
 * @package Vasileuski\MarkdownTests\Data
 */
class ListDataProvider implements ProviderInterface
{
    /**
     * @return \Iterator
     */
    public static function provide(): \Iterator
    {
        foreach (self::getItemsOptions() as $items) {
            foreach (self::getNumericOptions() as $numeric) {
                yield [ $items, $numeric ];
            }
        }
    }

    /**
     * @return array
     */
    private static function getNumericOptions(): array
    {
        return [
            true,
            false,
        ];
    }

    /**
     * @return array
     */
    private static function getItemsOptions(): array
    {
        return [
            [ ], //emtpy set
            iterator_to_array(StringsProvider::provide()),
        ];
    }
}
