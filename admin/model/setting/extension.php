<?php

function getInfo($filename, $type = 'module')
{
    $info = file_get_contents(DIR_APP . 'config/info/extension/' . $type . '/' . $filename . '.json');

    return json_decode($info, true);
}

function getInstalled($type)
{
    global $db;

    $extension_data = array();

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $db->escape($type) . "' ORDER BY code");

    foreach ($query->rows as $result) {
        $extension_data[] = $result['code'];
    }

    return $extension_data;
}

function install($type, $code)
{
    global $db;

    $db->query("INSERT INTO " . DB_PREFIX . "extension SET `type` = '" . $db->escape($type) . "', `code` = '" . $db->escape($code) . "'");
}

function uninstall($type, $code)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "extension WHERE `type` = '" . $db->escape($type) . "' AND `code` = '" . $db->escape($code) . "'");
    $db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = '" . $db->escape($code) . "'");
}