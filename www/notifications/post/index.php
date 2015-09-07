<?php

include_once 'fns/require_one_channel.php';
include_once '../../lib/mysqli.php';
$user = require_one_channel($mysqli);

unset(
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

$key = 'notifications/post';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'id_channels' => '',
        'text' => '',
    ];
}

$fnsDir = '../../fns';

include_once "$fnsDir/Users/Channels/index.php";
$channels = Users\Channels\index($mysqli, $user);

$options = [];
foreach ($channels as $channel) {
    $options[$channel->id] = htmlspecialchars($channel->channel_name);
}

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/select.php";
include_once "$fnsDir/Form/textarea.php";
include_once "$fnsDir/Notifications/maxLengths.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Notifications',
            'href' => '..',
        ],
    ],
    'Post a Notification',
    Page\sessionErrors('notifications/post/errors')
    .'<form method="post" action="submit.php">'
        .Form\select('id_channels', 'Channel',
            $options, $values['id_channels'], true)
        .'<div class="hr"></div>'
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => Notifications\maxLengths()['text'],
            'required' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Post a Notification')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Post a Notification', $content, '../../');
