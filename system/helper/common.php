<?php

function isMethod($method)
{
    return $_SERVER['REQUEST_METHOD'] === strtoupper($method);
}


function urlLink($route, $args = '')
{
    $url = HTTP_APP . '?route=' . $route;

    if ($args) {
        if (is_array($args)) {
            $url .= '&' . http_build_query($args);
        } else {
            $url .= '&' . ltrim($args, '&');
        }
    }

    return $url;
}

function inputPost($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : null;
}

function inputGet($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : null;
}


function redirect($url, $status = 302)
{
    header('Location: ' . str_replace(array('&', "\n", "\r"), array('&', '', ''), urlLink($url)), TRUE, $status);
    exit();
}

function assets_url($path = '')
{
    return HTTP_ROOT . 'resources/assets/' . $path;
}