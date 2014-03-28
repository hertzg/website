<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

if (array_key_exists('channels/add/values', $_SESSION)) {
    $values = $_SESSION['channels/add/values'];
} else {
    $values = ['channelname' => ''];
}

unset(
    $_SESSION['channels/errors'],
    $_SESSION['channels/messages']
);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/notes.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
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
        Page\sessionErrors('channels/add/errors')
        .'<form action="submit.php" method="post">'
            .Form\textfield('channelname', 'Channel name', [
                'value' => $values['channelname'],
                'maxlength' => 32,
                'autofocus' => true,
                'required' => true,
            ])
            .Form\notes([
                'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
                'Minimum 6 maximum 32 characters.',
            ])
            .'<div class="hr"></div>'
            .Form\button('Create')
        .'</form>'
    );

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Channel', $content, $base);
