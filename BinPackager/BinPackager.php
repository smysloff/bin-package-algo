<?php

declare(strict_types=1);

require_once 'Item.php';
require_once 'Bin.php';

/**
 * Class BinPackager
 */
class BinPackager
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    private $bins = [];

    /**
     * @var int
     */
    private $maxBinValue;

    /**
     * BinPackager constructor
     * @param int $maxBinValue
     */
    public function __construct(int $maxBinValue)
    {
        $this->maxBinValue = $maxBinValue;
    }

    /**
     * @param int $key
     * @param int $value
     */
    public function addItem(int $key, int $value): void
    {
        $this->items[] = new Item($key, $value);
    }

    /**
     * @return $this
     */
    public function packageItems(): BinPackager
    {
        $this->sortItemsDesc();
        foreach ($this->items as $item) {
            $bestFit = $this->bestFitPackage($item, $this->maxBinValue);
            $bestFit === null ?
                $this->addBin($item) :
                $this->bins[$bestFit]->addItem($item);
        }
        return $this;
    }

    /**
     * Print all items to stdout
     */
    public function printItems(): void
    {
        foreach ($this->items as $item) {
            echo $item->describe() . PHP_EOL;
        }
    }

    /**
     * Print all bins to stdout
     */
    public function printBins(): void
    {
        foreach ($this->bins as $bin) {
            echo $bin->describe() . PHP_EOL;
        }
    }

    /**
     * Sorts items by descending
     */
    private function sortItemsDesc(): void
    {
        usort($this->items, function ($item1, $item2) {
            return ($item1->getValue() > $item2->getValue()) ? -1 :
                (($item1->getValue() < $item2->getValue()) ? 1 : 0);
        });
    }

    /**
     * Finds Best-Fit package
     * @param Item $item
     * @param int $bestSpace
     * @return int|null
     */
    private function bestFitPackage(Item $item, int $bestSpace): ?int
    {
        $bestFit = null;
        foreach ($this->bins as $num => $bin) {
            $currentSpace = $bin->getFreeSpace();
            if ($currentSpace >= $item->getValue() &&
                $currentSpace < $bestSpace) {
                $bestFit = $num;
                $bestSpace = $currentSpace;
            }
        }
        return $bestFit;
    }

    /**
     * Creates new bin and puts an item there
     * @param Item $item
     */
    private function addBin(Item $item): void
    {
        $bin = new Bin($this->maxBinValue);
        $bin->addItem($item);
        $this->bins[] = $bin;
    }
}
