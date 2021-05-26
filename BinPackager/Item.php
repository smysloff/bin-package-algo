<?php

declare(strict_types=1);

/**
 * Class Item
 */
class Item
{
    /**
     * @var int
     */
    private $key;

    /**
     * @var int
     */
    private $value;

    /**
     * Item constructor
     *
     * @param int $key
     * @param int $value
     */
    public function __construct(int $key, int $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function describe(): string
    {
        return sprintf("[ %s - %s ]", $this->key, $this->value);
    }

    /**
     * @return int
     */
    public function getKey(): int
    {
        return $this->key;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
