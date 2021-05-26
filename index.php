<?php

declare(strict_types=1);

if ((int)phpversion() < 7)
    die('Error: requires php version 7 or higher');

require_once 'BinPackager' . DIRECTORY_SEPARATOR . 'BinPackager.php';

// task
$shelfLength = 1310;
$boxes = [
    1 => 774,
    2 => 214,
    3 => 694,
    4 => 321,
    5 => 674,
    6 => 527,
    7 => 120,
    8 => 567
];

// solution
$packager = new BinPackager($shelfLength);
foreach ($boxes as $key => $value) {
    $packager->addItem($key, $value);
}

echo PHP_EOL . "Shelf's length: " . $shelfLength . PHP_EOL;
echo PHP_EOL . 'All boxes:' . PHP_EOL;
$packager->printItems();

echo PHP_EOL . '[ packaging ... ]' . PHP_EOL;

echo PHP_EOL . 'Boxes has been packaged on the shelfs:' . PHP_EOL;
$packager->packageItems()->printBins();
