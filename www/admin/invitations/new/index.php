<?php

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

unset(
    $_SESSION['admin/invitations/errors'],
    $_SESSION['admin/invitations/messages'],
    $_SESSION['admin/invitations/view/messages']
);

$fnsDir = '../../../fns';

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => 'Invitations',
        'href' => '..',
    ],
    'New Invitation',
    '<form action="submit.php" method="post">'
        .create_form_items(['note' => ''])
        .'<div class="hr"></div>'
        .Form\button('Save Invitation')
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'New Invitation', $content, '../../');
