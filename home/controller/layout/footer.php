<?php

global $loader, $config;

$data['name'] = $config->get('config_name');
$data['phone'] = $config->get('config_phone');

echo $loader->view('layout/footer', $data);