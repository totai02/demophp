<?php

global $config, $loader;

if (isset($_GET['route'])) {
    $route = (string)$_GET['route'];
} else {
    $route = 'common/home';
}

$module_data = array();

$loader->model('setting/extension');

$extensions = getExtensions('module');

foreach ($extensions as $extension) {
    $module_info = $config->get($extension['code'] . '_module');

    $layouts = $module_info['layout'];

    if ($layouts) {
        foreach ($layouts as $key => $layout) {
            if (($key == $route) && $layout['position'] == 'content_bottom' && $layout['status']) {
                $module_data[] = array(
                    'code'       => $extension['code'],
                    'sort_order' => $layout['sort_order']
                );
            }
        }
    }
}

$sort_order = array();

foreach ($module_data as $key => $value) {
    $sort_order[$key] = $value['sort_order'];
}

array_multisort($sort_order, SORT_ASC, $module_data);

$data['modules'] = array();

foreach ($module_data as $module) {
    $module = $loader->controller('module/' . $module['code']);

    if ($module) {
        $data['modules'][] = $module;
    }
}

echo $loader->view('layout/content_bottom', $data);