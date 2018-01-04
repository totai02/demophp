<?php

function editSetting($data, $code)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "setting WHERE code = '" . $db->escape($code) . "'");

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $db->insert('setting', array(
                'code' => $code,
                'key' => $key,
                'value' => json_encode($value),
                'json' => 1
            ));
            // $db->query("INSERT INTO " . DB_PREFIX . "setting SET code = '" . $db->escape($code) . "', `key` = '" . $db->escape($key) . "', `value` = '" . $db->escape(json_encode($value)) . "', json = '1'");
        } else {
            $db->insert('setting', array(
                'code' => $code,
                'key' => $key,
                'value' => $value,
                'json' => 0
            ));
            // $db->query("INSERT INTO " . DB_PREFIX . "setting SET code = '" . $db->escape($code) . "', `key` = '" . $db->escape($key) . "', `value` = '" . $db->escape($value) . "', json = '0'");
        }
    }
}

function getSetting($code)
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE code = '" . $db->escape($code) . "'");

    $config_data = array();

    foreach ($query->rows as $result) {
        if ($result['json']) {
            $config_data[$result['key']] = json_decode($result['value'], true);
        } else {
            $config_data[$result['key']] = $result['value'];
        }
    }

    return $config_data;
}