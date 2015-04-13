<?php

include_once 'fns/require_admin.php';
require_admin();

unset(
    $_SESSION['admin/general-info/messages'],
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
    .Page\imageArrowLink('General Information',
        'general-info/', 'generic', ['id' => 'general-info'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('MySQL Settings',
        'mysql-settings/', 'generic', ['id' => 'mysql-settings'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Crontab',
        'ensure-crontab/', 'generic', ['id' => 'ensure-crontab'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Tables',
        'ensure-tables/', 'generic', ['id' => 'ensure-tables'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Data Folder',
        'ensure-data-dir/', 'generic', ['id' => 'ensure-data-dir'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Check Installation',
        'check-installation/', 'generic', ['id' => 'check-installation'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Set New Username/Password',
        'username-password/', 'generic', ['id' => 'username-password'])
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Administration', $content, '../');
