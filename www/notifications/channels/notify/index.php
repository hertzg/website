<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

unset($_SESSION['notifications/channels/view/messages']);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/textarea.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = Page\tabs(
    [
        [
            'title' => "Channel #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Post',
    Page\sessionErrors('notifications/channels/notify/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Post a Notification')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Channel #$id", $content, '../../../');
