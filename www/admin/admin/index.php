<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_admin.php';
$admin_user = require_admin();

unset(
    $_SESSION['admin/admin/change-password/errors'],
    $_SESSION['admin/admin/change-password/values'],
    $_SESSION['admin/admin/edit-profile/errors'],
    $_SESSION['admin/admin/edit-profile/values'],
    $_SESSION['admin/messages']
);

include_once '../../fns/Admin/get.php';
Admin\get($username, $hash, $salt, $sha512_hash, $sha512_key);

include_once '../../fns/Form/label.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/panel.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content =
    Page\create(
        [
            'title' => 'Administration',
            'href' => '../#admin',
        ],
        'Administrator',
        Page\sessionMessages('admin/admin/messages')
        .Page\text(
            'This is an emergency user that will let you administer'
            .' this Zvini instance even when it\'s experiencing a'
            .' misconfiguration or its MySQL server is down.'
        )
        .Form\label('Username', htmlspecialchars($username))
    )
    .Page\panel(
        'Options',
        Page\twoColumns(
            \Page\imageArrowLink('Change Password', 'change-password/',
                'edit-password', ['id' => 'change-password']),
            \Page\imageArrowLink('Edit Profile', 'edit-profile/',
                'edit-profile', ['id' => 'edit-profile'])
        )
    );

include_once '../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Administrator', $content, '../');
