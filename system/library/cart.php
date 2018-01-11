<?php

class Cart
{
    private $data = array();

    public function __construct()
    {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    public function getProducts()
    {
        global $db;

        if (!$this->data) {
            foreach ($_SESSION['cart'] as $key => $quantity) {
                $product = unserialize(base64_decode($key));

                $product_id = $product['product_id'];

                $product_query = $db->query("SELECT * FROM " . DB_PREFIX . "product p WHERE p.product_id='" . $product_id . "' AND p.status = '1'");

                if ($product_query->num_rows) {
                    $price = $product_query->row['price'];

                    // Product sale
                    $product_sale_query = $db->query("SELECT price FROM " . DB_PREFIX . "product_sale ps WHERE product_id = '" . (int)$product_id . "' AND ((from_at = '0' OR DATE(FROM_UNIXTIME(ps.from_at)) < DATE(NOW())) AND (to_at = '0' OR DATE(FROM_UNIXTIME(ps.to_at)) > DATE(NOW()))) ORDER BY price ASC LIMIT 1");

                    if ($product_sale_query->num_rows) {
                        $price = $product_sale_query->row['price'];
                    }

                    $this->data[$key] = array(
                        'key'        => $key,
                        'product_id' => $product_query->row['product_id'],
                        'name'       => $product_query->row['name'],
                        'image'      => $product_query->row['image'],
                        'quantity'   => $quantity,
                        'price'      => $price,
                    );
                } else {
                    $this->remove($key);
                }
            }
        }

        return $this->data;
    }


    public function add($product_id, $qty = 1)
    {
        $this->data = array();

        $product['product_id'] = (int)$product_id;

        $key = base64_encode(serialize($product));

        if ((int)$qty && ((int)$qty > 0)) {
            if (!isset($_SESSION['cart'][$key])) {
                $_SESSION['cart'][$key] = (int)$qty;
            } else {
                $_SESSION['cart'][$key] += (int)$qty;
            }
        }
    }

    public function update($key, $qty)
    {
        $this->data = array();

        if ((int)$qty && ((int)$qty > 0) && isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key] = (int)$qty;
        } else {
            $this->remove($key);
        }
    }

    public function remove($key)
    {
        $this->data = array();

        unset($_SESSION['cart'][$key]);
    }

    public function clear()
    {
        $this->data = array();

        $_SESSION['cart'] = array();
    }

    public function countProducts()
    {
        $product_total = 0;

        $products = $this->getProducts();

        foreach ($products as $product) {
            $product_total += $product['quantity'];
        }

        return $product_total;
    }

    public function hasProducts()
    {
        return count($_SESSION['cart']);
    }
}