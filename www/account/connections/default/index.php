<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages']
);

include_once '../../../fns/Page/imageArrowLink.php';

$permissions = '';
if ($user->anonymous_can_send_bookmark) {
    $permissions .= 'Can send bookmarks.<br />';
} else {
    $permissions .= 'Cannot send bookmarks.<br />';
}
if ($user->anonymous_can_send_channel) {
    $permissions .= 'Can send channels.<br />';
} else {
    $permissions .= 'Cannot send channels.<br />';
}
if ($user->anonymous_can_send_contact) {
    $permissions .= 'Can send contacts.<br />';
} else {
    $permissions .= 'Cannot send contacts.<br />';
}
if ($user->anonymous_can_send_file) {
    $permissions .= 'Can send files.<br />';
} else {
    $permissions .= 'Cannot send files.<br />';
}
if ($user->anonymous_can_send_note) {
    $permissions .= 'Can send notes.<br />';
} else {
    $permissions .= 'Cannot send notes.<br />';
}
if ($user->anonymous_can_send_task) {
    $permissions .= 'Can send tasks.';
} else {
    $permissions .= 'Cannot send tasks.';
}

$editLink = Page\imageArrowLink('Edit', 'edit/', 'edit-connection');

include_once '../../../fns/create_panel.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Connections',
            'href' => '..',
        ],
    ],
    "Default Connection",
    Page\sessionMessages('account/connections/default/messages')
    .Form\label('Other users', $permissions)
    .create_panel('Connection Options', $editLink)
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Default Connection', $content, $base);
