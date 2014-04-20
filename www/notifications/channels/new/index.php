<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

$key = 'notifications/channels/add/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'channel_name' => '',
        'public' => '',
    ];
}

unset(
    $_SESSION['notifications/channels/errors'],
    $_SESSION['notifications/channels/messages']
);

include_once '../../../fns/ChannelName/maxLength.php';
$maxLength = ChannelName\maxLength();

include_once '../../../fns/ChannelName/minLength.php';
$minLength = ChannelName\minLength();

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/checkbox.php';
include_once '../../../fns/Form/notes.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Channels',
            'href' => '..',
        ],
    ],
    'New',
    Page\sessionErrors('notifications/channels/add/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('channel_name', 'Channel name', [
            'value' => $values['channel_name'],
            'maxlength' => $maxLength,
            'autofocus' => true,
            'required' => true,
        ])
        .Form\notes([
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            "Minimum $minLength maximum $maxLength characters.",
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'public', 'Mark as Public', $values['public'])
        .'<div class="hr"></div>'
        .Form\button('Create')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Channel', $content, $base);
