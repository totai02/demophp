<?php

global $loader, $user;

$data['heading_title'] = 'Login';

$error = array();

if (isMethod('post')) {
    if ($user->login(inputPost('username'), inputPost('password'))) {
        redirect('common/dashboard');
    } else {
        $error['warning'] = 'Tên hoặc mật khẩu không đúng';
    }
}

if (isset($error['warning'])) {
    $data['error_waring'] = $error['warning'];
} else {
    $data['error_waring'] = '';
}


$data['action'] = urlLink('auth/login');
$data['forgot'] = urlLink('auth/forgot');

echo $loader->view('auth/login', $data);

