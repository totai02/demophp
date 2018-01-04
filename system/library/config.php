<?php

class Config
{
    protected $data = array();

    public function __construct()
    {
        $files = glob(DIR_APP . 'config/*.php');

        foreach ($files as $file) {
            $item = include_once($file);

            foreach ($item as $key => $value) {
                $this->set('local.' . basename($file, '.php') . '.' . $key, $value);
            }

            unset($item);
        }
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    public function all()
    {
        return $this->data;
    }
}