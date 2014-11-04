<?php

include_once '../fns/require_admin.php';
require_admin();

unset(
    $_SESSION['admin/mysql-settings/edit/errors'],
    $_SESSION['admin/mysql-settings/edit/values']
);

$fnsDir = '../../fns';

include_once "$fnsDir/get_mysqli_config.php";
get_mysqli_config($host, $username, $password, $db);

if ($host === '') {
    $host = '<span class="form-label-default">Default</span>';
} else {
    $host = htmlspecialchars($host);
}

if ($username === '') {
    $username = '<span class="form-label-default">Default</span>';
} else {
    $username = htmlspecialchars($username);
}

if ($password === '') {
    $password = '<span class="form-label-default">None</span>';
} else {
    $password = preg_replace('/./', '*', $password);
    $password = htmlspecialchars($password);
}

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/imageArrowLink.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '..',
        ],
    ],
    'MySQL Settings',
    Page\sessionErrors('admin/mysql-settings/errors')
    .Page\sessionMessages('admin/mysql-settings/messages')
    .Form\label('Host', $host)
    .'<div class="hr"></div>'
    .Form\label('Username', $username)
    .'<div class="hr"></div>'
    .Form\label('Password', $password)
    .'<div class="hr"></div>'
    .Form\label('Database', htmlspecialchars($db))
    .create_panel(
        'Options',
        Page\staticTwoColumns(
            Page\imageArrowLink('Edit', 'edit/', 'none'),
            Page\imageLink('Test', 'submit-test.php', 'none')
        )
    )
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('MySQL Settings', $content, '../../');
