<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$key = 'notifications/channels/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$channel;

$base = '../../../';

include_once '../../../fns/ChannelName/maxLength.php';
$maxLength = ChannelName\maxLength();

include_once '../../../fns/ChannelName/minLength.php';
$minLength = ChannelName\minLength();

include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/checkbox.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/notes.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "Channel #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit',
    Page\sessionErrors('notifications/channels/edit/errors')
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
        .Form\button('Save Channel')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Channel #$id", $content, $base);
