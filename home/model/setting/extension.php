<?php

function getExtensions($type)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $db->escape($type) . "'");

    return $query->rows;
}