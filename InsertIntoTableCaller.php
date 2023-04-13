<?php

declare(strict_types=1);

require_once __DIR__ . '/class.php';
require_once __DIR__ . '/connectDB.php';

$db = new dbStuff();

try {
    $db->addNewRow(
        Product::toProduct(
            $_POST['sku'],
            $_POST['name'],
            $_POST['price'],
            $_POST['size'],
            $_POST['weight'],
            $_POST['dimension'],
        ),
    );
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
