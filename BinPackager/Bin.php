<?php

declare(strict_types=1);

require_once 'Item.php';

/**
 * Class Bin
 */
class Bin
{
    /**
     * @var int
     */
    private $maxValue;

    /**
     * @var int
     */
    private $currentValue;

    /**
     * @var array
     */
    private $items = [];

    /**
     * Bin constructor
     * @param int $maxValue
     */
    public function __construct(int $maxValue)
    {
        $this->maxValue = $maxValue;
        $this->currentValue = 0;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item): Bin
    {
        $this->items[] = $item;
        $this->currentValue += $item->getValue();
        return $this;
    }

    /**
     * @return string
     */
    public function describe(): string
    {
        $bin = sprintf('(%04s of %s) ', $this->currentValue, $this->maxValue);
        foreach ($this->items as $item) {
            $bin .= $item->describe();
        }
        return $bin;
    }

    /**
     * @return int
     */
    public function getFreeSpace(): int
    {
        return ($this->maxValue - $this->currentValue);
    }
}
