<?php

function denied (&$permissions, $text) {
    $permissions .= "<span class=\"denied\">$text</span><br />";
}

function granted (&$permissions, $text) {
    $permissions .= "<span class=\"granted\">$text</span><br />";
}

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
    granted($permissions, 'Can send bookmarks.');
} else {
    denied($permissions, 'Cannot send bookmarks.');
}
if ($user->anonymous_can_send_channel) {
    granted($permissions, 'Can send channels.');
} else {
    denied($permissions, 'Cannot send channels.');
}
if ($user->anonymous_can_send_contact) {
    granted($permissions, 'Can send contacts.');
} else {
    denied($permissions, 'Cannot send contacts.');
}
if ($user->anonymous_can_send_file) {
    granted($permissions, 'Can send files.');
} else {
    denied($permissions, 'Cannot send files.');
}
if ($user->anonymous_can_send_note) {
    granted($permissions, 'Can send notes.');
} else {
    denied($permissions, 'Cannot send notes.');
}
if ($user->anonymous_can_send_task) {
    granted($permissions, 'Can send tasks.');
} else {
    denied($permissions, 'Cannot send tasks.');
}

$editLink = Page\imageArrowLink('Edit', 'edit/', 'edit-connection');

include_once '../../../fns/create_panel.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
$content = Page\tabs(
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
echo_page($user, 'Default Connection', $content, $base, [
    'head' => '<link rel="stylesheet" type="text/css" href="../view.css" />',
]);
