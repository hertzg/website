<?php

$fnsDir = __DIR__.'/../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageArrowLink.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../#help',
    ],
    'Help',
    Page\imageArrowLink('Admin API Documentation',
        'admin-api-doc/', 'api-doc', ['id' => 'admin-api-doc'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Exchange API Documentation',
        'exchange-api-doc', 'api-doc', ['id' => 'exchange-api-doc'])
);

include_once '../fns/echo_admin_page.php';
echo_admin_page($user, 'Help', $content, '../');
