<?php

declare(strict_types=1);

require_once __DIR__ . '/connectDB.php';

$db = new dbStuff();

$result = $db->deleteStuff($_POST['sku']);
echo $result;
