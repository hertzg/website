<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_invitation.php';
include_once '../../../lib/mysqli.php';
list($invitation, $id, $admin_user) = require_invitation($mysqli);

unset($_SESSION['admin/invitations/view/messages']);

$fnsDir = '../../../fns';

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => "Invitation #$id",
        'href' => "../view/?id=$id#edit",
    ],
    'Edit',
    '<form action="submit.php" method="post">'
        .create_form_items(['note' => $invitation->note])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, "Edit Invitation #$id", $content, '../../');
