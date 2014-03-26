<?php

include_once '../../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli, '../..');

$key = 'channels/users/add/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = ['username' => ''];
}

unset(
    $_SESSION['channels/users/errors'],
    $_SESSION['channels/users/messages']
);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => "../../view/?id=$id",
        ],
        [
            'title' => 'Users',
            'href' => "../?id=$id",
        ],
    ],
    'Add',
    Page\sessionErrors('channels/users/add/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Add User')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Add User', $content, '../../../');
