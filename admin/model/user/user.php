<?php

function addUser($data)
{
    global $db;

    $db->insert('user', array(
        'user_group_id' => $data['user_group_id'],
        'username'      => $data['name'],
        'password'      => $data['password'],
        'status'        => $data['status'],
        'create_at'     => strtotime('now'),
        'update_at'     => strtotime('now')
    ));
}

function editUser($user_id, $data)
{
    global $db;

    $db->query("UPDATE " . DB_PREFIX . "user SET `user_group_id` = '" . $db->escape($data['user_group_id']) . "', `username` = '" . $db->escape($data['username']) . "', `password` = '" . $db->escape($data['password']) . "', `status` = '" . $db->escape($data['status']) . "', `create_at` = '" . $db->escape($data['create_at']) . "', `update_at` = '" . $db->escape($data['update_at']) . "' WHERE user_id = '" . $user_id . "'");
}

function deleteUser($user_id)
{
    global $db;

    $db->query("DELETE FROM " . DB_PREFIX . "user WHERE user_id = '" . $user_id . "'");
}

function getUsers($data = array())
{
    global $db;

    $sql = "SELECT * FROM " . DB_PREFIX . "user";

    if (isset($data['start']) && isset($data['limit'])) {
        $sql .= " LIMIT " . (int)$data['start'] . ", " . (int)$data['limit'];
    }

    $query = $db->query($sql);

    return $query->rows;
}

function getUser($user_id)
{
    global $db;

    $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user WHERE user_id = '" . $user_id . "'");

    return $query->row;
}

function getTotalUser($data = array())
{
    global $db;

    $query = $db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "user");

    return $query->row['total'];
}