<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_invitation.php';
include_once '../../../lib/mysqli.php';
list($invitation, $id, $admin_user) = require_invitation($mysqli);

unset($_SESSION['admin/invitations/view/messages']);

$fnsDir = '../../../fns';

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($invitation, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the invitation?',
        'Yes, delete invitation', "submit.php?id=$id", "../view/?id=$id");

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
echo_admin_page($admin_user, "Delete Invitation #$id?", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', '../../../'),
    'scripts' => $scripts,
]);
