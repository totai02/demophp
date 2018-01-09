<?php

function addColor($data)
{
    global $db;

    $db->insert('color', array(
        'name' => $data['name'],
    ));
}

function editColor($color_id, $data)
{
    global $db;

    $db->update('color', array(
        'name' => $data['name'],
    ), " WHERE color_id = '" . $color_id . "'");
}

function deleteColor($color_id)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "color WHERE color_id = '" . $color_id . "'");
}

function getColors($data = array())
{
    global $db;

    $sql = "SELECT * FROM " . DB_PREFIX . "color";

    if (isset($data['start']) && isset($data['limit'])) {
        $sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
    }

    $query = $db->query($sql);

    return $query->rows;
}

function getColor($color_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "color WHERE color_id = '" . $color_id . "'");

    return $query->row;
}

function getTotalColor($data = array())
{
    global $db;

    $query = $db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "color");

    return $query->row['total'];
}