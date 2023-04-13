<?php

declare(strict_types=1);

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;

    public function __construct($sku, $name, $price)
    {
        $this->sku   = $sku;
        $this->name  = $name;
        $this->price = $price;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    abstract public function sqlQuerySave();
    abstract public function toJSON();

    public static function toProduct($sku, $name, $price, $size, $weight, $dimension)
    {
        if (!is_null($size) && $size != null && $size != "NULL") {
            return new DVD($sku, $name, $price, $size);
        } elseif (!is_null($dimension) && $dimension != null && $dimension != "NULL") {
            return new Furniture($sku, $name, $price, $dimension);
        }

        return new Book($sku, $name, $price, $weight);
    }
}
class DVD extends Product
{
    protected $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function sqlQuerySave()
    {
        $query = "INSERT INTO `GeneralItems` (sku, name, price, size) VALUES ('{$this->sku}', '{$this->name}', {$this->price}, {$this->size})";

        return $query;
    }

    public function toJSON()
    {
        return json_encode([
            'sku'   => $this->getSku(),
            'name'  => $this->getName(),
            'price' => $this->getPrice(),
            'size'  => $this->getSize(),
        ]);
    }
}

class Furniture extends Product
{
    protected $dimension;

    public function __construct($sku, $name, $price, $dimension)
    {
        parent::__construct($sku, $name, $price);
        $this->dimension = $dimension;
    }

    public function getDimension()
    {
        return $this->dimension;
    }

    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }

    public function sqlQuerySave()
    {
        $query = "INSERT INTO `GeneralItems` (sku, name, price, dimension) VALUES ('{$this->sku}', '{$this->name}', {$this->price}, '{$this->dimension}')";

        return $query;
    }

    public function toJSON()
    {
        return json_encode([
            'sku'       => $this->getSku(),
            'name'      => $this->getName(),
            'price'     => $this->getPrice(),
            'dimension' => $this->getDimension(),
        ]);
    }
}

class Book extends Product
{
    protected $weight;

    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function sqlQuerySave()
    {
        $query = "INSERT INTO `GeneralItems` (sku, name, price, weight) VALUES ('{$this->sku}', '{$this->name}', {$this->price}, {$this->weight})";

        return $query;
    }

    public function toJSON()
    {
        return json_encode([
            'sku'    => $this->getSku(),
            'name'   => $this->getName(),
            'price'  => $this->getPrice(),
            'weight' => $this->getWeight(),
        ]);
    }
}
