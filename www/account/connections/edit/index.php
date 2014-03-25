<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

$base = '../../../';

$key = 'account/connections/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = (array)$connection;
}

unset($_SESSION['account/connections/view/messages']);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/checkbox.php';
include_once '../../../fns/Form/hidden.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "Connection #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit',
    Page\sessionErrors('account/connections/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'can_send_channel',
            'Can send channels.',
            $values['can_send_channel'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Connection #$id", $content, $base);
