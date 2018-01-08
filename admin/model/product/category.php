<?php

function addCategory($data)
{
    global $db;

    $db->insert('category', array(
        'parent_id'   => $data['parent_id'],
        'name'        => $data['name'],
        'description' => $data['description'],
        'image'       => $data['image'],
        'status'      => $data['status'],
        'create_at'   => strtotime('now'),
        'update_at'   => strtotime('now'),
    ));
}

function editCategory($category_id, $data)
{
    global $db;

    $db->update('category', array(
        'parent_id'   => $data['parent_id'],
        'name'        => $data['name'],
        'description' => $data['description'],
        'image'       => $data['image'],
        'status'      => $data['status'],
        'update_at'   => strtotime('now'),
    ), " WHERE category_id = '" . $category_id . "'");
}

function deleteCategory($category_id)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "category WHERE category_id = '" . $category_id . "'");
}

function getCategories($data = array())
{
    global $db;

    $sql = "SELECT * FROM " . DB_PREFIX . "category";

    if (isset($data['start']) && isset($data['limit'])) {
        $sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
    }

    $query = $db->query($sql);

    return $query->rows;
}

function getCategory($category_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category WHERE category_id = '" . $category_id . "'");

    return $query->row;
}

function getTotalCategory($data = array())
{
    global $db;

    $query = $db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "category");

    return $query->row['total'];
}