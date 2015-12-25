<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset(
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages']
);

include_once '../fns/format_permissions.php';
$permissions = format_permissions($user->anonymous_can_send_bookmark,
    $user->anonymous_can_send_calculation, $user->anonymous_can_send_channel,
    $user->anonymous_can_send_contact, $user->anonymous_can_send_file,
    $user->anonymous_can_send_note, $user->anonymous_can_send_place,
    $user->anonymous_can_send_schedule, $user->anonymous_can_send_task);

include_once "$fnsDir/Page/imageArrowLink.php";
$editLink = Page\imageArrowLink('Edit',
    'edit/', 'edit-connection', ['id' => 'edit']);

include_once "$fnsDir/create_panel.php";
include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Connections',
            'href' => '../#default',
        ],
    ],
    'Default Connection',
    Page\sessionMessages('account/connections/default/messages')
    .Form\label('Other users', $permissions)
    .create_panel('Connection Options', $editLink),
    Page\newItemButton('../new/', 'Connection', !$user->num_connections)
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Default Connection', $content, $base);
