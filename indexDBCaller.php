<?php

declare(strict_types=1);

require_once __DIR__ . '/connectDB.php';

$db       = new dbStuff();
$products = $db->selectAll();

$jsonArray = [];
foreach ($products as $product) {
    $jsonArray[] = $product->toJSON();
}
$jsonString = '[' . implode(',', $jsonArray) . ']';

echo $jsonString;
