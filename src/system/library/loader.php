<?php

class Loader
{
    public function controller($controller)
    {
        $file = DIR_APP . 'controller/' . $controller . '.php';

        if (file_exists($file)) {
            ob_start();
            require_once($file);

            return ob_get_clean();
        } else {
            trigger_error('Can not load controller ' . $file);
        }
    }

    public function view($template, $data = array())
    {
        $file = DIR_TEMPLATE . $template . '.tpl';
        if (file_exists($file)) {
            extract($data);

            ob_start();
            require($file);

            return ob_get_clean();
        } else {
            trigger_error('Can not load view ' . $file);
        }
    }

    public function model($model)
    {
        $file = DIR_APP . 'model/' . $model . '.php';

        if (file_exists($file)) {
            require_once($file);
        } else {
            trigger_error('Can not load model ' . $file);
        }
    }
}