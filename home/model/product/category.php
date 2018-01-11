<?php

function getCategory($category_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c WHERE c.category_id = '" . (int)$category_id . "' AND c.status = '1'");

    return $query->row;
}

function getCategories($parent_id = 0)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "category c WHERE c.parent_id = '" . (int)$parent_id . "' AND c.status = '1' ORDER BY c.sort_order, LCASE(c.name)");

    return $query->rows;
}

function getTotalCategoriesByCategoryId($parent_id = 0)
{
    global $db;

    $query = $db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category WHERE parent_id = '" . (int)$parent_id . "' AND status = '1'");

    return $query->row['total'];
}