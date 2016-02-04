<?php

include_once 'fns/require_admin.php';
$admin_user = require_admin();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/get_mysqli.php';
$mysqli = get_mysqli();

if (!$mysqli->connect_errno) {
    include_once '../fns/Table/ensureAll.php';
    \Table\ensureAll($mysqli);
}

include_once '../fns/Page/imageArrowLink.php';
$helpLink = Page\imageArrowLink('Help', 'help/', 'help', ['id' => 'help']);

include_once 'fns/create_database_links.php';
include_once 'fns/create_general_info_link.php';
include_once 'fns/create_mysql_link.php';
include_once '../fns/create_panel.php';
include_once '../fns/Page/sessionMessages.php';
$content = Page\sessionMessages('admin/messages')
    .create_database_links($mysqli)
    .create_general_info_link()
    .'<div class="hr"></div>'
    .create_mysql_link($mysqli)
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Crontab',
        'ensure-crontab/', 'generic', ['id' => 'ensure-crontab'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Ensure Data Folder',
        'ensure-data-dir/', 'generic', ['id' => 'ensure-data-dir'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Check Installation',
        'check-installation/', 'generic', ['id' => 'check-installation'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Set New Username/Password',
        'username-password/', 'generic', ['id' => 'username-password']);

if ($admin_user) {
    include_once '../fns/Page/create.php';
    $content = Page\create(
        [
            'title' => 'Home',
            'href' => '../home/#admin',
            'localNavigation' => true,
        ],
        'Administration',
        $content
    );
} else {
    include_once '../fns/Page/title.php';
    $content = Page\title('Administration', $content);
}

$content .= create_panel('Options', $helpLink);

include_once '../fns/echo_page.php';
echo_page($admin_user, 'Administration', $content, '../', [
    'logo_href' => $admin_user ? '../home/' : './',
]);
