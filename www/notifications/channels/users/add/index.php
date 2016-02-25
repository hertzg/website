<?php

include_once '../../../../../lib/defaults.php';

include_once '../../fns/require_channel.php';
include_once '../../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli, '../');

$key = 'notifications/channels/users/add/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['subscriber_username' => ''];

unset(
    $_SESSION['notifications/channels/users/errors'],
    $_SESSION['notifications/channels/users/messages']
);

$fnsDir = '../../../../fns';

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Users',
        'href' => "../?id=$id#add",
    ],
    'Add',
    Page\sessionErrors('notifications/channels/users/add/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('subscriber_username', 'Username', [
            'value' => $values['subscriber_username'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Add User')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Add User to Channel #$channel->id",
    $content, '../../../../');
