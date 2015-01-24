<?php

include_once 'fns/require_admin.php';
require_admin();

unset(
    $_SESSION['admin/mysql-settings/messages'],
    $_SESSION['admin/username-password/errors'],
    $_SESSION['admin/username-password/values']
);

include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [],
    'Administration',
    Page\sessionMessages('admin/messages')
    .Page\imageArrowLink('MySQL Settings',
        'mysql-settings/', 'none', ['id' => 'mysql-settings'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Crontab',
        'ensure-crontab/', 'none', ['id' => 'ensure-crontab'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Tables',
        'ensure-tables/', 'none', ['id' => 'ensure-tables'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Data Folder',
        'ensure-data-dir/', 'none', ['id' => 'ensure-data-dir'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Check Installation',
        'check-installation/', 'none', ['id' => 'check-installation'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Set New Username/Password',
        'username-password/', 'none', ['id' => 'username-password'])
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Administration', $content, '../');
