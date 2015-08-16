<?php

include_once '../fns/require_invitation.php';
include_once '../../../lib/mysqli.php';
list($invitation, $id) = require_invitation($mysqli);

unset($_SESSION['admin/invitations/view/messages']);

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/create_view_page.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_view_page($invitation, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the invitation?',
        'Yes, delete invitation', "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_guest_page.php";
echo_guest_page("Delete Invitation #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
    'scripts' => $scripts,
]);
