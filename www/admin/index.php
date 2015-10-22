<?php

include_once 'fns/require_admin.php';
require_admin();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/ClientAddress/get.php';
$client_address = ClientAddress\get();

include_once '../fns/Page/imageArrowLink.php';

$title = 'General Information';
$href = 'general-info/';
$icon = 'generic';
$options = ['id' => 'general-info'];
if ($client_address === false) {
    $description =
        '<span class="redText">'
            .'With this settings a client IP address cannot be detected.'
        .'</span>';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    $generalLink = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);
} else {
    $generalLink = Page\imageArrowLink($title, $href, $icon, $options);
}

include_once '../fns/MysqlConfig/get.php';
MysqlConfig\get($host, $username, $password, $db);

$mysqli = @new mysqli($host, $username, $password, $db);

$title = 'MySQL Settings';
$href = 'mysql-settings/';
$icon = 'generic';
$options = ['id' => 'mysql-settings'];
if ($mysqli->connect_errno) {
    $description =
        '<span class="redText">'
            ."The settings doesn't work. "
            .htmlspecialchars($mysqli->connect_error)
        .'</span>';
    include_once '../fns/Page/imageArrowLinkWithDescription.php';
    $mysqlLink = Page\imageArrowLinkWithDescription(
        $title, $description, $href, $icon, $options);
} else {
    $mysqlLink = Page\imageArrowLink($title, $href, $icon, $options);
}

include_once 'fns/create_admin_api_keys_link.php';
include_once 'fns/create_invitations_link.php';
include_once 'fns/create_users_link.php';
include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [],
    'Administration',
    Page\sessionMessages('admin/messages')
    .$generalLink
    .'<div class="hr"></div>'
    .$mysqlLink
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
    .'<div class="hr"></div>'
    .create_admin_api_keys_link($mysqli)
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Admin API Documentation',
        'api-doc/', 'api-doc', ['id' => 'api-doc'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Invalid Signins', 'invalid-signins/',
        'invalid-sign-ins', ['id' => 'invalid-signins'])
    .'<div class="hr"></div>'
    .create_invitations_link($mysqli)
    .'<div class="hr"></div>'
    .create_users_link($mysqli)
    .'<div class="hr"></div>'
);

include_once '../fns/echo_page.php';
echo_page(null, 'Administration', $content, '../', [
    'logo_href' => './',
]);
