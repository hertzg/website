<?php

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

unset($_SESSION['notifications/channels/users/messages']);

$id_channels = $subscribedChannel->id_channels;

include_once '../../../../fns/Page/imageArrowLink.php';
$title = 'Remove User';
$href = "../delete/?id=$id";
$deleteLink = Page\imageArrowLink($title, $href, 'remove-user');

include_once '../../../../fns/create_panel.php';
include_once '../../../../fns/Page/tabs.php';
include_once '../../../../fns/Form/label.php';
include_once '../../../../fns/Page/sessionMessages.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => "../../view/?id=$id_channels",
        ],
        [
            'title' => 'Users',
            'href' => "../?id=$id_channels",
        ],
    ],
    "User #$id",
    Page\sessionMessages('notifications/channels/users/view/messages')
    .Form\label('Username', htmlspecialchars($subscribedChannel->subscriber_username))
    .create_panel('Options', $deleteLink)
);

include_once '../../../../fns/echo_page.php';
echo_page($user, "Channel User #$id", $content, '../../../../');
