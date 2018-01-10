<?php

class Config
{
    protected $data = array();

    public function __construct()
    {
        $default = include_once (DIR_SYSTEM . 'config/default.php');

        foreach ($default as $key => $value){
            $this->set('default.' . $key, $value);
        }

        $files = glob(DIR_APP . 'config/*.php');

        foreach ($files as $file) {
            $basename = basename($file, '.php');

            if ($basename !== 'define') {
                $item = include_once($file);

                foreach ($item as $key => $value) {
                    $this->set('local.' . $basename . '.' . $key, $value);
                }

                unset($item);
            }
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