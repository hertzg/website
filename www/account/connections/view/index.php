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

$title = 'Edit';
$href = "../edit/?id=$id";
$editLink = Page\imageArrowLink($title, $href, 'edit-connection');

$title = 'Delete';
$href = "../delete/?id=$id";
$deleteLink = Page\imageArrowLink($title, $href, 'trash-bin');

include_once '../fns/format_permissions.php';
$permissions = format_permissions($connection->can_send_bookmark,
    $connection->can_send_channel, $connection->can_send_contact,
    $connection->can_send_file, $connection->can_send_note,
    $connection->can_send_task);

include_once '../../../fns/create_panel.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/label.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/twoColumns.php';
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
    "Connection #$id",
    Page\sessionMessages('account/connections/view/messages')
    .Form\label('Username', htmlspecialchars($connection->username))
    .'<div class="hr"></div>'
    .Form\label('This user', $permissions)
    .create_panel('Conneciton Options', Page\twoColumns($editLink, $deleteLink))
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Connection #$id", $content, '../../../', [
    'head' => '<link rel="stylesheet" type="text/css" href="../view.css" />',
]);
