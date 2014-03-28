<?php

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_subscribed_channel($mysqli, '../..');

unset($_SESSION['notifications/in-subscribed-channel/messages']);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../../../home/',
            ),
        ),
        'Notifications',
        Page\text(
            'Are you sure you want to delete notifications in this channel?'
        )
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, delete notifications',
            "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../?id=$id", 'no')
    );

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete Notifications?', $content, '../../../');
