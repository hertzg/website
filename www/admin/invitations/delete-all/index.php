<?php

include_once 'fns/require_invitations.php';
require_invitations($mysqli, $invitations);

$fnsDir = '../../../fns';

include_once '../fns/render_invitations.php';
render_invitations($invitations, $items, '../');

include_once "$fnsDir/Page/imageLink.php";
$deleteAllLink = Page\imageLink(
    'Delete All Invitations', './', 'trash-bin');

include_once "$fnsDir/create_panel.php";
$optionsPanel = create_panel('Options', $deleteAllLink);

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/create_content.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    create_content($items, $optionsPanel, false, '../')
    .Page\confirmDialog('Are you sure you want to delete all the invitations?',
        'Yes, delete invitations', 'submit.php', '..');

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
echo_admin_page('Delete All Invitations?', $content, '../../', [
    'head' => compressed_css_link('confirmDialog', '../../../'),
]);
