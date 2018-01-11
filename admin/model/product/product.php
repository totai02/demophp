<?php

function addProduct($data)
{
    global $db;

    $db->insert('product', array(
        'name'        => $data['name'],
        'description' => $data['description'],
        'tag'         => $data['tag'],
        'image'       => $data['image'],
        'price'       => $data['price'],
        'status'      => $data['status'],
        'create_at'   => strtotime('now'),
        'update_at'   => strtotime('now'),
    ));

    $product_id = $db->getLastId();

    // add image
    if (isset($data['product_image'])) {
        foreach ($data['product_image'] as $product_image) {
            $db->insert('product_image', array(
                'product_id' => $product_id,
                'image'      => $product_image
            ));
        }
    }

    // add attribute
    if (isset($data['product_attribute'])) {
        foreach ($data['product_attribute'] as $product_attribute) {
            $db->insert('product_attribute', array(
                'product_id'   => $product_id,
                'attribute_id' => $product_attribute['attribute_id'],
                'description'  => $product_attribute['description'],
                'sort_order'   => $product_attribute['sort_order'],
            ));
        }
    }

    // add sale
    if (isset($data['product_sale'])) {
        foreach ($data['product_sale'] as $product_sale) {
            $db->insert('product_sale', array(
                'product_id' => $product_id,
                'price'      => $product_sale['price'],
                'from_at'    => strtotime($product_sale['from_at']),
                'to_at'      => strtotime($product_sale['to_at']),
            ));
        }
    }

    // add category
    if (isset($data['product_category'])) {
        foreach ($data['product_category'] as $category_id) {
            $db->insert('product_to_category', array(
                'product_id'  => $product_id,
                'category_id' => $category_id
            ));
        }
    }

    // add color
    if (isset($data['product_color'])) {
        foreach ($data['product_color'] as $color_id) {
            $db->insert('product_color', array(
                'product_id' => $product_id,
                'color_id'   => $color_id
            ));
        }
    }
}

function editProduct($product_id, $data)
{
    global $db;


    $db->update('product', array(
        'name'        => $data['name'],
        'description' => $data['description'],
        'tag'         => $data['tag'],
        'image'       => $data['image'],
        'price'       => $data['price'],
        'status'      => $data['status'],
        'update_at'   => strtotime('now'),
    ), " WHERE product_id = '" . $product_id . "'");

    // add image
    $db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . $product_id . "'");

    if (isset($data['product_image'])) {
        foreach ($data['product_image'] as $product_image) {
            $db->insert('product_image', array(
                'product_id' => $product_id,
                'image'      => $product_image
            ));
        }
    }

    // add attribute
    $db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . $product_id . "'");

    if (isset($data['product_attribute'])) {
        foreach ($data['product_attribute'] as $product_attribute) {
            $db->insert('product_attribute', array(
                'product_id'   => $product_id,
                'attribute_id' => $product_attribute['attribute_id'],
                'description'  => $product_attribute['description'],
                'sort_order'   => $product_attribute['sort_order'],
            ));
        }
    }

    // add sale
    $db->query("DELETE FROM " . DB_PREFIX . "product_sale WHERE product_id = '" . $product_id . "'");

    if (isset($data['product_sale'])) {
        foreach ($data['product_sale'] as $product_sale) {
            $db->insert('product_sale', array(
                'product_id' => $product_id,
                'price'      => $product_sale['price'],
                'from_at'    => strtotime($product_sale['from_at']),
                'to_at'      => strtotime($product_sale['to_at']),
            ));
        }
    }

    // add category
    $db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "'");

    if (isset($data['product_category'])) {
        foreach ($data['product_category'] as $category_id) {
            $db->insert('product_to_category', array(
                'product_id'  => $product_id,
                'category_id' => $category_id
            ));
        }
    }

    // add color
    $db->query("DELETE FROM " . DB_PREFIX . "product_color WHERE product_id = '" . $product_id . "'");

    if (isset($data['product_color'])) {
        foreach ($data['product_color'] as $color_id) {
            $db->insert('product_color', array(
                'product_id' => $product_id,
                'color_id'   => $color_id
            ));
        }
    }
}

function deleteProduct($product_id)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . $product_id . "'");
    $db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . $product_id . "'");
    $db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . $product_id . "'");
    $db->query("DELETE FROM " . DB_PREFIX . "product_sale WHERE product_id = '" . $product_id . "'");
    $db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "'");
    $db->query("DELETE FROM " . DB_PREFIX . "product_color WHERE product_id = '" . $product_id . "'");
}

function getProducts($data = array())
{
    global $db;

    $sql = "SELECT " . $db->tableName('product') . ".* FROM " . DB_PREFIX . "product";


    if (!empty($data['key'])) {
        $key = "'%" . $data['key'] . "%'";
        $filter = array();
        if (!empty($data['search'])) {
            if (!empty($data['search']['name'])) {
                $filter[] = $db->tableName('product') . ".name LIKE " . $key;
            }
            if (!empty($data['search']['tag'])) {
                $filter[] = $db->tableName('product') . ".tag LIKE " . $key;
            }
            if (!empty($data['search']['category'])) {
                $sql .= ", " . $db->tableName('product_to_category') . ", " . $db->tableName('category') . " WHERE " . $db->tableName('product') . ".product_id = " . $db->tableName('product_to_category') . ".product_id AND ";
                $sql .= $db->tableName('product_to_category') . ".category_id = " . $db->tableName('category') . ".category_id AND ";
                $filter[] = $db->tableName("category") . ".name LIKE " . $key;
            } else {
                $sql .= " WHERE ";
            }
        }
        $sql .= " ( " . implode(' OR ', $filter) . " ) ";
    }

    if (isset($data['start']) && isset($data['limit'])) {
        $sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
    }

    $query = $db->query($sql);

    return $query->rows;
}

function getProduct($product_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product WHERE product_id = '" . $product_id . "'");

    return $query->row;
}

function getProductCategories($product_id)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "'");

    return $query->rows;
}

function getProductImage($product_id)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . $product_id . "'");

    return $query->rows;
}

function getProductColor($product_id)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "product_color WHERE product_id = '" . $product_id . "'");

    return $query->rows;
}

function getProductAttribute($product_id)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . $product_id . "'");

    return $query->rows;
}

function getProductSale($product_id)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "product_sale WHERE product_id = '" . $product_id . "'");

    return $query->rows;
}

function getTotalProduct($data = array())
{
    global $db;

    $sql = "SELECT COUNT(*) as total FROM " . DB_PREFIX . "product";

    if (!empty($data['key'])) {
        $key = "'%" . $data['key'] . "%'";
        $filter = array();
        if (!empty($data['search'])) {
            if (!empty($data['search']['name'])) {
                $filter[] = $db->tableName('product') . ".name LIKE " . $key;
            }
            if (!empty($data['search']['tag'])) {
                $filter[] = $db->tableName('product') . ".tag LIKE " . $key;
            }
            if (!empty($data['search']['category'])) {
                $sql .= ", " . $db->tableName('product_to_category') . ", " . $db->tableName('category') . " WHERE " . $db->tableName('product') . ".product_id = " . $db->tableName('product_to_category') . ".product_id AND ";
                $sql .= $db->tableName('product_to_category') . ".category_id = " . $db->tableName('category') . ".category_id AND ";
                $filter[] = $db->tableName("category") . ".name LIKE " . $key;
            } else {
                $sql .= " WHERE ";
            }
        }
        $sql .= " ( " . implode(' OR ', $filter) . " ) ";
    }

    $query = $db->query($sql);

    return $query->row['total'];
}