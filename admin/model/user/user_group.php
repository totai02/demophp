<?php

function addUserGroup($data)
{
    global $db;

    $db->insert('user_group', array(
        'name'       => $data['name'],
        'permission' => json_encode($data['permission'])
    ));
}

function editUserGroup($user_group_id, $data)
{
    global $db;

    $db->query("UPDATE " . DB_PREFIX . "user_group SET `name` = '" . $db->escape($data['name']) . "', `permission` = '" . $db->escape(json_encode($data['permission'])) . "' WHERE user_group_id = '" . $user_group_id . "'");
}

function getUserGroups($data = array())
{
    global $db;

    $query = $db->query("SELECT * FROM " . DB_PREFIX . "user_group");

    return $query->rows;
}

function getUserGroup($user_group_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . $user_group_id . "'");

    return $query->row;
}