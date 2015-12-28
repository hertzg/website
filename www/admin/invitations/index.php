<?php

include_once '../fns/require_admin.php';
require_admin();

$fnsDir = '../../fns';

include_once "$fnsDir/Invitations/index.php";
include_once '../../lib/mysqli.php';
$invitations = Invitations\index($mysqli);

$items = [];
if ($invitations) {

    include_once 'fns/render_invitations.php';
    render_invitations($invitations, $items);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteAllLink = Page\imageLink(
        'Delete All Invitations', 'delete-all/', 'trash-bin');

    include_once "$fnsDir/create_panel.php";
    $optionsPanel = create_panel('Options', $deleteAllLink);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No invitations');
    $optionsPanel = '';
}

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once 'fns/create_content.php';
$content = create_content($items, $optionsPanel, !count($invitations));

include_once '../fns/echo_admin_page.php';
echo_admin_page('Invitations', $content, '../');
