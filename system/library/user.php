<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/12/2017
 * Time: 9:23 PM
 */

class User
{
    protected $user_info;
    protected $permission;

    public function __construct()
    {
        if (isset($_SESSION['user_id'])) {
            $user_info = $this->getUser($_SESSION['user_id']);

            $this->user_info = $user_info;

            $this->permission = $this->getPermission($user_info['user_group_id']);
        }
    }

    function login($username, $password)
    {
        $pass_md5 = $this->md5_Encode($password);

        $query = $this->checkUser($username, $pass_md5);

        if (count($query) != 0) {
            $_SESSION['user_id'] = $query['user_id'];

            $this->user_info = $query;

            return true;
        } else {
            return false;
        }
    }

    public function isLogin()
    {
        return isset($_SESSION['user_id']);
    }

    public function getId()
    {
        return $this->user_info['user_id'];
    }

    public function getUserInfo()
    {
        return $this->user_info;
    }

    public function getUsername()
    {
        return $this->user_info['username'];
    }

    function md5_Encode($string)
    {
        return md5($string);
    }

    public function hasPermission($type, $route){
        if(isset($this->permission[$type])){
            if(in_array($route, $this->permission[$type])){
                return true;
            }
        }

        return false;
    }

    protected function getUser($user_id)
    {
        global $db;

        $query = $db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");

        return $query->row;
    }

    protected function checkUser($userName, $password)
    {
        global $db;

        $query = $db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $db->escape($userName) . "' AND password='" . $db->escape($password) . "' AND status=1");

        return $query->row;
    }

    protected function getUsers($data = array())
    {
        global $db;

        $query = $db->query("SELECT * FROM " . DB_PREFIX . "user");

        return $query->rows;
    }

    protected function getPermission($user_group_id){
        global $db;

        $query = $db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . $user_group_id . "'");

        $data = [];

        if($query->num_rows) {
            $data = json_decode($query->row['permission'], true);
        }

        return $data;
    }
}