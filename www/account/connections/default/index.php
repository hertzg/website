<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages']
);

include_once '../fns/format_permissions.php';
$permissions = format_permissions($user->anonymous_can_send_bookmark,
    $user->anonymous_can_send_channel, $user->anonymous_can_send_contact,
    $user->anonymous_can_send_file, $user->anonymous_can_send_note,
    $user->anonymous_can_send_place, $user->anonymous_can_send_task);

include_once '../../../fns/Page/imageArrowLink.php';
$editLink = Page\imageArrowLink('Edit',
    'edit/', 'edit-connection', ['id' => 'edit']);

include_once '../../../fns/create_panel.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/newItemButton.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/tabs.php';
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
    Page\newItemButton('../new/', 'Connection')
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Default Connection', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css" href="../view.css" />',
]);
