<?php

$base = '../../../../';

include_once '../../../../fns/require_user.php';
$user = require_user($base);

$key = 'account/connections/default/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'can_send_channel' => $user->anonymous_can_send_channel,
    ];
}

unset($_SESSION['account/connections/default/messages']);

include_once '../../../../fns/create_tabs.php';
include_once '../../../../fns/Form/button.php';
include_once '../../../../fns/Form/checkbox.php';
include_once '../../../../fns/Form/label.php';
include_once '../../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Default Connection',
            'href' => '..',
        ],
    ],
    'Edit',
    Page\sessionErrors('account/connections/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\label('Username', 'Any other username')
        .'<div class="hr"></div>'
        .Form\checkbox($base, 'can_send_channel',
            'Can send channels.',
            $values['can_send_channel'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
    .'</form>'
);

include_once '../../../../fns/echo_page.php';
echo_page($user, 'Edit Default Connection', $content, $base);
