<?php

function addAttribute($data)
{
    global $db;

    $db->insert('attribute', array(
        'name' => $data['name'],
    ));
}

function editAttribute($attribute_id, $data)
{
    global $db;

    $db->update('attribute', array(
        'name' => $data['name'],
    ), " WHERE attribute_id = '" . $attribute_id . "'");
}

function deleteAttribute($attribute_id)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "attribute WHERE attribute_id = '" . $attribute_id . "'");
}

function getAttributes($data = array())
{
    global $db;

    $sql = "SELECT * FROM " . DB_PREFIX . "attribute";

    if (isset($data['start']) && isset($data['limit'])) {
        $sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
    }

    $query = $db->query($sql);

    return $query->rows;
}

function getAttribute($attribute_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "attribute WHERE attribute_id = '" . $attribute_id . "'");

    return $query->row;
}

function getTotalAttribute($data = array())
{
    global $db;

    $query = $db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "attribute");

    return $query->row['total'];
}