<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

unset(
    $_SESSION['admin/mysql-settings/edit/errors'],
    $_SESSION['admin/mysql-settings/edit/values']
);

$fnsDir = '../../fns';

include_once "$fnsDir/MysqlConfig/get.php";
MysqlConfig\get($host, $username, $password, $db);

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
}

include_once "$fnsDir/get_mysqli.php";
$mysqli = get_mysqli();

if ($mysqli->connect_errno) {
    $status_html =
        '<span class="colorText red">'
            .'Doesn\'t work. '.htmlspecialchars($mysqli->connect_error)
        .'</span>';
} else {

    $status_html = 'Work.';

    include_once "$fnsDir/Table/ensureAll.php";
    \Table\ensureAll($mysqli);

}

include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageArrowLink.php";
include_once "$fnsDir/Page/panel.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content =
    Page\create(
        [
            'title' => 'Administration',
            'href' => '../#mysql-settings',
        ],
        'MySQL Settings',
        Page\sessionMessages('admin/mysql-settings/messages')
        .Form\label('Host', $host)
        .'<div class="hr"></div>'
        .Form\label('Username', $username)
        .'<div class="hr"></div>'
        .Form\label('Password', $password)
        .'<div class="hr"></div>'
        .Form\label('Database', htmlspecialchars($db))
        .'<div class="hr"></div>'
        .Form\label('The settings', $status_html)
    )
    .Page\panel(
        'Options',
        Page\imageArrowLink('Edit', 'edit/', 'generic', ['id' => 'edit'])
    );

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'MySQL Settings', $content, '../');
