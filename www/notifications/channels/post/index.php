<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['notifications/channels/view/messages']);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/textarea.php";
include_once "$fnsDir/Notifications/maxLengths.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Channel #$id",
        'href' => "../view/?id=$id#post",
    ],
    'Post',
    Page\sessionErrors('notifications/channels/post/errors')
    .'<form action="submit.php" method="post">'
        .Form\textarea('text', 'Text', [
            'maxlength' => Notifications\maxLengths()['text'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Post a Notification')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Channel #$id", $content, $base, [
    'scripts' => compressed_js_script('flexTextarea', $base),
]);
