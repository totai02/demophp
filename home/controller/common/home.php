<?php

global $loader;

$data['title'] = 'welcome home';

$loader->model('product/product');

$a = getProduct(10);

var_dump($a);

echo $loader->view('common/home', $data);
