<?php

function addSize($data)
{
    global $db;

    $db->insert('size', array(
        'name' => $data['name'],
    ));
}

function editSize($size_id, $data)
{
    global $db;

    $db->update('size', array(
        'name' => $data['name'],
    ), " WHERE size_id = '" . $size_id . "'");
}

function deleteSize($size_id)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "size WHERE size_id = '" . $size_id . "'");
}

function getSizes($data = array())
{
    global $db;

    $sql = "SELECT * FROM " . DB_PREFIX . "size";

    if (isset($data['start']) && isset($data['limit'])) {
        $sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
    }

    $query = $db->query($sql);

    return $query->rows;
}

function getSize($size_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "size WHERE size_id = '" . $size_id . "'");

    return $query->row;
}

function getTotalSize($data = array())
{
    global $db;

    $query = $db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "size");

    return $query->row['total'];
}