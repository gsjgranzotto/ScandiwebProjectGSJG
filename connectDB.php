<?php

declare(strict_types=1);

require_once __DIR__ . '/class.php';

class dbStuff
{
    private $conn;
    private $servername = "localhost";
    private $username   = "id20502492_admin";
    private $password   = "|Ef/iz$|^d9<!S2U";
    private $database   = "id20502492_scandiwebproject";

    public function __construct()
    {
        $this->conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->database,
        );

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function selectAll()
    {
        $sql    = "SELECT * FROM `GeneralItems`;";
        $result = $this->conn->query($sql);

        $products = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = Product::toProduct(
                $row['sku'],
                $row['name'],
                $row['price'],
                $row['size'],
                $row['weight'],
                $row['dimension'],
            );
        }

        return $products;
    }

    public function deleteStuff($sku)
    {
        $skuList = "'" . implode("', '", $sku) . "'";
        $sql     = "DELETE FROM GeneralItems WHERE GeneralItems.sku IN ($skuList)";
        $this->conn->query($sql);

        return $sql;
    }

    public function addNewRow($product)
    {
        $sql    = $product->sqlQuerySave();
        $result = $this->conn->query($sql);

        return $result;
    }
}
