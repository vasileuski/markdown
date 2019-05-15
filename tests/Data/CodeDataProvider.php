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
 * Class CodeDataProvider
 * @package Vasileuski\MarkdownTests\Data
 */
class CodeDataProvider implements ProviderInterface
{
    /**
     * @return \Iterator
     */
    public static function provide(): \Iterator
    {
        foreach (self::getCodeOptions() as $code) {
            foreach (self::getInlineOptions() as $inline) {
                foreach (self::getLanguageOptions() as $language) {
                    yield [ $code, $inline, $language ];
                }
            }
        }
    }

    /**
     * @var array
     */
    private static function getCodeOptions(): array
    {
        return [
            '',
            ' ',
            '$this->getSomeFunction()',
            'php bin/console commad --option',
        ];
    }

    /**
     * @var array
     */
    private static function getInlineOptions(): array
    {
        return [
            true,
            false
        ];
    }

    /**
     * @var array
     */
    private static function getLanguageOptions(): array
    {
        return [
            '',
            ' ',
            ' json',
            'php-##',
            'bash',
        ];
    }
}
