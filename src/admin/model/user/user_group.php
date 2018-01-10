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

function deleteUserGroup($user_group_id)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . $user_group_id . "'");
}

function getUserGroups($data = array())
{
    global $db;

    $sql = "SELECT * FROM " . DB_PREFIX . "user_group";

    if (isset($data['start']) && isset($data['limit'])) {
        $sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
    }

    $query = $db->query($sql);

    return $query->rows;
}

function getUserGroup($user_group_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . $user_group_id . "'");

    return $query->row;
}

function getTotalUserGroup($data = array())
{
    global $db;

    $query = $db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "user_group");

    return $query->row['total'];
}

function addPermission($user_group_id, $type, $route)
{
    global $db;

    $user_group_query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_group_id . "'");

    if ($user_group_query->num_rows) {
        $data = json_decode($user_group_query->row['permission'], true);

        $data[$type][] = $route;

        $db->query("UPDATE " . DB_PREFIX . "user_group SET permission = '" . $db->escape(json_encode($data)) . "' WHERE user_group_id = '" . (int)$user_group_id . "'");
    }
}

function removePermission($user_group_id, $type, $route)
{
    global $db;

    $user_group_query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_group_id . "'");

    if ($user_group_query->num_rows) {
        $data = json_decode($user_group_query->row['permission'], true);

        $data[$type] = array_diff($data[$type], array($route));

        $db->query("UPDATE " . DB_PREFIX . "user_group SET permission = '" . $db->escape(json_encode($data)) . "' WHERE user_group_id = '" . (int)$user_group_id . "'");
    }
}