<?php

include_once '../fns/require_admin.php';
require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/get_mysqli_config.php";
get_mysqli_config($host, $username, $password, $db);

include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '..',
        ],
    ],
    'MySQL Settings',
    Form\textfield('host', 'Host', [
        'value' => $host,
    ])
    .'<div class="hr"></div>'
    .Form\textfield('username', 'Username', [
        'value' => $username,
    ])
    .'<div class="hr"></div>'
    .Form\textfield('password', 'Password', [
        'value' => $password,
    ])
    .'<div class="hr"></div>'
    .Form\textfield('db', 'Database', [
        'value' => $db,
    ])
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('MySQL Settings', $content, '../../');
