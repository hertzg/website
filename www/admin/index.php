<?php

include_once 'fns/require_admin.php';
require_admin();

unset(
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
    .Page\imageArrowLink('Check Installation', 'check-installation/', 'none')
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Set New Username/Password', 'username-password/', 'none')
);

include_once '../fns/echo_guest_page.php';
echo_guest_page('Administration', $content, '../');
