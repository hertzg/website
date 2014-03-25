<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

$base = '../../../';

$values = (array)$connection;

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/checkbox.php';
include_once '../../../fns/Form/textfield.php';
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
    '<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
        ])
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'can_subscribe_to_my_channel',
            'Can subscribe to my channel',
            $values['can_subscribe_to_my_channel'])
        .'<div class="hr"></div>'
        .Form\button('Save Connection')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Connection #$id", $content, $base);
