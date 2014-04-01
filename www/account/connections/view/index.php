<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

$id = abs((int)$id);

include_once '../../../fns/Connections/get.php';
$connection = Connections\get($mysqli, $user->id_users, $id);

unset(
    $_SESSION['account/connections/edit/errors'],
    $_SESSION['account/connections/edit/values'],
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages']
);

include_once '../../../fns/Page/imageArrowLink.php';

$options = [];

$title = 'Edit Connection';
$href = "../edit/?id=$id";
$options[] = Page\imageArrowLink($title, $href, 'edit-connection');

$title = 'Delete Connection';
$href = "../delete/?id=$id";
$options[] = Page\imageArrowLink($title, $href, 'trash-bin');

$permissions = '';
if ($connection->can_send_bookmark) {
    $permissions .= 'Can send bookmarks.<br />';
} else {
    $permissions .= 'Cannot send bookmarks.<br />';
}
if ($connection->can_send_channel) {
    $permissions .= 'Can send channels.<br />';
} else {
    $permissions .= 'Cannot send channels.<br />';
}
if ($connection->can_send_contact) {
    $permissions .= 'Can send contacts.<br />';
} else {
    $permissions .= 'Cannot send contacts.<br />';
}
if ($connection->can_send_note) {
    $permissions .= 'Can send notes.<br />';
} else {
    $permissions .= 'Cannot send notes.<br />';
}
if ($connection->can_send_task) {
    $permissions .= 'Can send tasks.';
} else {
    $permissions .= 'Cannot send tasks.';
}

include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
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
    "Connection #$id",
    Page\sessionMessages('account/connections/view/messages')
    .Form\label('Username', htmlspecialchars($connection->username))
    .'<div class="hr"></div>'
    .Form\label('This user', $permissions)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Connection #$id", $content, '../../../');
