<?php

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

unset(
    $_SESSION['admin/mysql-settings/errors'],
    $_SESSION['admin/mysql-settings/messages']
);

$fnsDir = '../../../fns';

$key = 'admin/mysql-settings/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    include_once "$fnsDir/MysqlConfig/get.php";
    MysqlConfig\get($host, $username, $password, $db);

    $values = [
        'host' => $host,
        'username' => $username,
        'password' => $password,
        'db' => $db,
    ];

}

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'MySQL Settings',
        'href' => '../#edit',
    ],
    'Edit',
    Page\sessionErrors('admin/mysql-settings/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('host', 'Host', [
            'value' => $values['host'],
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
        ])
        .'<div class="hr"></div>'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
        ])
        .'<div class="hr"></div>'
        .Form\textfield('db', 'Database', [
            'value' => $values['db'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Save Settings')
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Edit MySQL Settings', $content, '../../');
