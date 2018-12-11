<?php
sleep(3);
if ($_GET['name'] != 'lxf') {
    echo json_encode([
        'ret' => FALSE,
        'msg' => '用户名不存在'
    ]);
    exit;
}

if ($_GET['psd'] != '666') {
    echo json_encode([
        'ret' => FALSE,
        'msg' => '密码错误'
    ]);
    exit;
}
echo json_encode([
    'ret' => TRUE,
    'msg' => ''
]);