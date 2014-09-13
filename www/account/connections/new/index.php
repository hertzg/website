<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages']
);

$key = 'account/connections/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'username' => '',
        'can_send_bookmark' => false,
        'can_send_channel' => false,
        'can_send_contact' => false,
        'can_send_file' => false,
        'can_send_note' => false,
        'can_send_task' => false,
    ];
}

include_once '../fns/create_form_items.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Connections',
            'href' => '..',
        ],
    ],
    'New',
    Page\sessionErrors('account/connections/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($base, $values)
        .'<div class="hr"></div>'
        .Form\button('Save Connection')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Connection', $content, $base);
