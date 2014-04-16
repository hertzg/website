<?php

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribed_channel, $id, $user) = require_subscribed_channel($mysqli, '../../..');

unset($_SESSION['notifications/channels/users/messages']);

$id_channels = $subscribed_channel->id_channels;
$public_subscriber = $subscribed_channel->public_subscriber;

if ($public_subscriber) {
    $optionsPanel = '';
} else {

    include_once '../../../../fns/Page/imageArrowLink.php';
    $title = 'Remove User';
    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink($title, $href, 'remove-user');

    include_once '../../../../fns/create_panel.php';
    $optionsPanel = create_panel('Options', $deleteLink);

}

include_once '../../../../fns/create_tabs.php';
include_once '../../../../fns/Form/label.php';
include_once '../../../../fns/Page/sessionMessages.php';
include_once '../../../../fns/Page/text.php';
$content = create_tabs(
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
    .Form\label('Username', htmlspecialchars($subscribed_channel->subscriber_username))
    .'<div class="hr"></div>'
    .Page\text(($public_subscriber ? 'Public' : 'Private').' subscriber.')
    .$optionsPanel
);

include_once '../../../../fns/echo_page.php';
echo_page($user, "Channel User #$id", $content, '../../../../');
