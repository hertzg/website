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
    $password = htmlspecialchars($password);
}

$key = 'admin/mysql-settings/messages';
if (array_key_exists($key, $_SESSION)) $messages = $_SESSION[$key];
else $messages = [];

include_once "$fnsDir/get_mysqli.php";
$mysqli = get_mysqli();

if ($mysqli->connect_errno) {
    include_once "$fnsDir/Page/errors.php";
    $errors = Page\errors([
        "The settings doesn't work.",
        htmlspecialchars($mysqli->connect_error),
    ]);
} else {

    $errors = '';
    $messages[] = 'The settings work.';

    include_once "$fnsDir/Table/ensureAll.php";
    \Table\ensureAll($mysqli);

}

if ($messages) {
    include_once "$fnsDir/Page/messages.php";
    $messages = Page\messages($messages);
} else {
    $messages = '';
}

include_once "$fnsDir/Page/panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageArrowLink.php";
$content =
    Page\create(
        [
            'title' => 'Administration',
            'href' => '../#mysql-settings',
        ],
        'MySQL Settings',
        $messages.$errors
        .Form\label('Host', $host)
        .'<div class="hr"></div>'
        .Form\label('Username', $username)
        .'<div class="hr"></div>'
        .Form\label('Password', $password)
        .'<div class="hr"></div>'
        .Form\label('Database', htmlspecialchars($db))
    )
    .Page\panel(
        'Options',
        Page\imageArrowLink('Edit', 'edit/', 'generic', ['id' => 'edit'])
    );

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'MySQL Settings', $content, '../');
