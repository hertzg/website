<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

$id = abs((int)$id);

include_once '../../../fns/Connections/get.php';
$connection = Connections\get($mysqli, $user->idusers, $id);

unset(
    $_SESSION['account/connections/edit/index_errors'],
    $_SESSION['account/connections/edit/index_values'],
    $_SESSION['account/connections/index_errors'],
    $_SESSION['account/connections/index_messages']
);

include_once '../../../fns/Page/imageArrowLink.php';

$options = [];

$title = 'Edit Connection';
$href = "../edit/?id=$id";
$options[] = Page\imageArrowLink($title, $href, 'edit-connection');

$title = 'Delete Connection';
$href = "../delete/?id=$id";
$options[] = Page\imageArrowLink($title, $href, 'trash-bin');

$permissions = '<div>';
if ($connection->can_subscribe_to_my_channel) {
    $permissions .= 'Can subscribe to my channel.';
} else {
    $permissions .= 'Cannot subscribe to my channel';
}
$permissions .= '</div>';

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
    Page\sessionMessages('account/connections/view/index_messages')
    .Form\label('Username', htmlspecialchars($connection->username))
    .'<div class="hr"></div>'
    .Form\label('This user', $permissions)
    .create_panel('Options', join('<div class="hr"></div>', $options))
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Connection #$id", $content, '../../../');
