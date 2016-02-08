<?php

include_once 'fns/require_one_channel.php';
include_once '../../lib/mysqli.php';
$user = require_one_channel($mysqli);

unset(
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

$key = 'notifications/post/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'id_channels',
        'id_channels' => '',
        'text' => '',
    ];
}

$base = '../../';
$fnsDir = '../../fns';
$focus = $values['focus'];

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
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Notifications',
        'href' => '..',
    ],
    'Post a Notification',
    Page\sessionErrors('notifications/post/errors')
    .'<form action="submit.php" method="post">'
        .Form\select('id_channels', 'Channel', $options,
            $values['id_channels'], $focus === 'id_channels')
        .'<div class="hr"></div>'
        .Form\textarea('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => Notifications\maxLengths()['text'],
            'required' => true,
            'autofocus' => $focus === 'text',
        ])
        .'<div class="hr"></div>'
        .Form\button('Post a Notification')
    .'</form>'
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Post a Notification', $content, $base, [
    'scripts' => compressed_js_script('flexTextarea', $base),
]);
