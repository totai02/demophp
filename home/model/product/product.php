<?php

function updateViewed($product_id)
{
    global $db;

    $db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
}

function getProduct($product_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT *, p.name AS name, p.image, (SELECT price FROM " . DB_PREFIX . "product_sale ps WHERE ps.product_id = p.product_id AND ((ps.from_at = '0' OR DATE(FROM_UNIXTIME(ps.from_at)) < DATE(NOW())) AND (ps.to_at = '0' OR DATE(FROM_UNIXTIME(ps.to_at)) > DATE(NOW()))) ORDER BY ps.price ASC LIMIT 1) AS sale, p.sort_order FROM " . DB_PREFIX . "product p WHERE p.product_id = '" . (int)$product_id . "' AND p.status = '1'");

    if ($query->num_rows) {
        return array(
            'product_id'  => $query->row['product_id'],
            'name'        => $query->row['name'],
            'description' => $query->row['description'],
            'tag'         => $query->row['tag'],
            'image'       => $query->row['image'],
            'price'       => $query->row['price'],
            'sale'        => $query->row['sale'],
            'sort_order'  => $query->row['sort_order'],
            'status'      => $query->row['status'],
            'create_at'   => $query->row['create_at'],
            'update_at'   => $query->row['update_at'],
            'viewed'      => $query->row['viewed']
        );
    } else {
        return false;
    }
}

function getProducts($data = array())
{
    global $db;

    $sql = "SELECT p.product_id, (SELECT price FROM " . DB_PREFIX . "product_sale ps WHERE ps.product_id = p.product_id AND ((ps.from_at = '0' OR DATE(FROM_UNIXTIME(ps.from_at)) < DATE(NOW())) AND (ps.to_at = '0' OR DATE(FROM_UNIXTIME(ps.to_at)) > DATE(NOW()))) ORDER BY ps.price ASC LIMIT 1) AS sale";

    if (!empty($data['filter_category_id'])) {
        $sql .= " FROM " . DB_PREFIX . "product_to_category p2c LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
    } else {
        $sql .= " FROM " . DB_PREFIX . "product p";
    }

    $sql .= " WHERE p.status = '1'";

    if (!empty($data['filter_category_id'])) {
        $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
    }

    if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
        $sql .= " AND (";

        if (!empty($data['filter_name'])) {
            $implode = array();

            $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

            foreach ($words as $word) {
                $implode[] = "p.name LIKE '%" . $db->escape($word) . "%'";
            }

            if ($implode) {
                $sql .= " " . implode(" AND ", $implode) . "";
            }

            if (!empty($data['filter_description'])) {
                $sql .= " OR p.description LIKE '%" . $db->escape($data['filter_name']) . "%'";
            }
        }

        if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
            $sql .= " OR ";
        }

        if (!empty($data['filter_tag'])) {
            $sql .= "p.tag LIKE '%" . $db->escape($data['filter_tag']) . "%'";
        }

        if (!empty($data['filter_name'])) {
            $sql .= " OR LCASE(p.model) = '" . $db->escape(strtolower($data['filter_name'])) . "'";
        }

        $sql .= ")";
    }

    $sql .= " GROUP BY p.product_id";

    $sort_data = array(
        'p.name',
        'p.price',
        'p.sort_order',
        'p.create_at'
    );

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
        if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
            $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
        } elseif ($data['sort'] == 'p.price') {
            $sql .= " ORDER BY (CASE WHEN sale IS NOT NULL THEN sale ELSE p.price END)";
        } else {
            $sql .= " ORDER BY " . $data['sort'];
        }
    } else {
        $sql .= " ORDER BY p.sort_order";
    }

    if (isset($data['order']) && ($data['order'] == 'DESC')) {
        $sql .= " DESC, LCASE(p.name) DESC";
    } else {
        $sql .= " ASC, LCASE(p.name) ASC";
    }

    if (isset($data['start']) || isset($data['limit'])) {
        if ($data['start'] < 0) {
            $data['start'] = 0;
        }

        if ($data['limit'] < 1) {
            $data['limit'] = 20;
        }

        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    }

    $product_data = array();

    $query = $db->query($sql);

    foreach ($query->rows as $result) {
        $product_data[$result['product_id']] = getProduct($result['product_id']);
    }

    return $product_data;
}

function getProductSales($data = array())
{
    global $db;

    $sql = "SELECT DISTINCT ps.product_id FROM " . DB_PREFIX . "product_sale ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) WHERE p.status = '1' AND ((ps.from_at = '0' OR DATE(FROM_UNIXTIME(ps.from_at)) < DATE(NOW())) AND (ps.to_at = '0' OR DATE(FROM_UNIXTIME(ps.to_at)) > DATE(NOW()))) GROUP BY ps.product_id";

    $sort_data = array(
        'p.name',
        'p.model',
        'ps.price',
        'p.sort_order'
    );

    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
        if ($data['sort'] == 'p.name' || $data['sort'] == 'p.model') {
            $sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
        } else {
            $sql .= " ORDER BY " . $data['sort'];
        }
    } else {
        $sql .= " ORDER BY p.sort_order";
    }

    if (isset($data['order']) && ($data['order'] == 'DESC')) {
        $sql .= " DESC, LCASE(p.name) DESC";
    } else {
        $sql .= " ASC, LCASE(p.name) ASC";
    }

    if (isset($data['start']) || isset($data['limit'])) {
        if ($data['start'] < 0) {
            $data['start'] = 0;
        }

        if ($data['limit'] < 1) {
            $data['limit'] = 20;
        }

        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
    }

    $product_data = array();

    $query = $db->query($sql);

    foreach ($query->rows as $result) {
        $product_data[$result['product_id']] = getProduct($result['product_id']);
    }

    return $product_data;
}

function getLatestProducts($limit)
{
    global $db;

    $product_data = array();

    $query = $db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE status = '1' ORDER BY create_at DESC LIMIT " . (int)$limit);

    foreach ($query->rows as $result) {
        $product_data[$result['product_id']] = getProduct($result['product_id']);
    }

    return $product_data;
}

function getPopularProducts($limit)
{
    global $db;

    $product_data = array();

    $query = $db->query("SELECT product_id FROM " . DB_PREFIX . "product WHERE status = '1' ORDER BY viewed DESC, create_at DESC LIMIT " . (int)$limit);

    foreach ($query->rows as $result) {
        $product_data[$result['product_id']] = getProduct($result['product_id']);
    }

    return $product_data;
}

function getBestSellerProducts($limit)
{
    global $db;

    $product_data = array();

    $query = $db->query("SELECT op.product_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) WHERE o.order_status_id > '0' AND p.status = '1' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);

    foreach ($query->rows as $result) {
        $product_data[$result['product_id']] = getProduct($result['product_id']);
    }

    return $product_data;
}

function getProductAttributes($product_id)
{
    global $db;

    $product_attribute_data = array();

    $product_attribute_query = $db->query("SELECT * FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "'");

    foreach ($product_attribute_query->rows as $product_attribute) {
        $product_attribute_data[] = array(
            'attribute_id' => $product_attribute['attribute_id'],
            'name'         => $product_attribute['name'],
            'description'  => $product_attribute['description']
        );
    }

    return $product_attribute_data;
}

function getProductImages($product_id)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");

    return $query->rows;
}

function getProductColors($product_id)
{
    global $db;

    $product_color_data = array();

    $product_color_query = $db->query("SELECT * FROM " . DB_PREFIX . "product_color pa LEFT JOIN " . DB_PREFIX . "color a ON (pa.color_id = a.color_id) WHERE pa.product_id = '" . (int)$product_id . "'");

    foreach ($product_color_query->rows as $product_color) {
        $product_color_data[] = array(
            'color_id' => $product_color['color_id'],
            'name'         => $product_color['name'],
        );
    }

    return $product_color_data;
}

function getProductCategories($product_id)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

    return $query->rows;
}

function getTotalProducts($data = array())
{
    global $db;

    $sql = "SELECT COUNT(DISTINCT p.product_id) AS total";

    if (!empty($data['filter_category_id'])) {
        $sql .= " FROM " . DB_PREFIX . "product_to_category p2c";

        $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
    } else {
        $sql .= " FROM " . DB_PREFIX . "product p";
    }

    $sql .= " WHERE 1=1";

    if (!empty($data['filter_category_id'])) {
        $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
    }

    if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
        $sql .= " AND (";

        if (!empty($data['filter_name'])) {
            $implode = array();

            $words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

            foreach ($words as $word) {
                $implode[] = "p.name LIKE '%" . $db->escape($word) . "%'";
            }

            if ($implode) {
                $sql .= " " . implode(" AND ", $implode) . "";
            }

            if (!empty($data['filter_description'])) {
                $sql .= " OR p.description LIKE '%" . $db->escape($data['filter_name']) . "%'";
            }
        }

        if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
            $sql .= " OR ";
        }

        if (!empty($data['filter_tag'])) {
            $sql .= "p.tag LIKE '%" . $db->escape(strtolower($data['filter_tag'])) . "%'";
        }

        if (!empty($data['filter_name'])) {
            $sql .= " OR LCASE(p.model) = '" . $db->escape(strtolower($data['filter_name'])) . "'";
        }

        $sql .= ")";
    }

    $query = $db->query($sql);

    return $query->row['total'];
}

function getTotalProductSpecials()
{
    global $db;

    $query = $db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM " . DB_PREFIX . "product_sale ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) WHERE p.status = '1' AND ((ps.from_at = '0' OR DATE(FROM_UNIXTIME(ps.from_at)) < DATE(NOW())) AND (ps.to_at = '0' OR DATE(FROM_UNIXTIME(ps.to_at)) > DATE(NOW())))");

    if (isset($query->row['total'])) {
        return $query->row['total'];
    } else {
        return 0;
    }
}

