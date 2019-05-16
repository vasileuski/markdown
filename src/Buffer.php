<?php

namespace Vasileuski\Markdown;

class Buffer
{
    /**
     * @var string
     */
    private $buffer = '';

    /**
     * @return Buffer
     */
    public function new(): self
    {
        return new self();
    }

    /**
     * @return Buffer
     */
    public function clear(): self
    {
        $this->buffer = '';

        return $this;
    }

    /**
     * @param string ...$elements
     *
     * @return Buffer
     */
    public function add(string ...$elements): self
    {
        $this->buffer .= implode('', $elements);

        return $this;
    }

    /**
     * @param bool $clear
     *
     * @return string
     */
    public function out(bool $clear = true): string
    {
        $content = $this->buffer;

        if ($clear) {
            $this->clear();
        }

        return $content;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->out(false);
    }
}
