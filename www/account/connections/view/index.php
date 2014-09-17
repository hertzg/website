<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

unset(
    $_SESSION['account/connections/edit/errors'],
    $_SESSION['account/connections/edit/values'],
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages']
);

include_once '../../../fns/Page/imageArrowLink.php';

$editLink = Page\imageArrowLink('Edit', "../edit/?id=$id", 'edit-connection');

$deleteLink = Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin');

include_once '../fns/format_permissions.php';
$permissions = format_permissions($connection->can_send_bookmark,
    $connection->can_send_channel, $connection->can_send_contact,
    $connection->can_send_file, $connection->can_send_note,
    $connection->can_send_task);

include_once '../../../fns/Page/staticTwoColumns.php';
$optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

include_once '../../../fns/create_panel.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/newItemButton.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
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
    .create_panel('Conneciton Options', $optionsContent),
    Page\newItemButton('../new/', 'New', 'Connection')
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Connection #$id", $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="../view.css" />',
]);
