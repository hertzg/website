<?php

$base = '../../../../';

include_once '../../../../fns/require_user.php';
$user = require_user($base);

$key = 'account/connections/default/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'can_send_bookmark' => $user->anonymous_can_send_bookmark,
        'can_send_channel' => $user->anonymous_can_send_channel,
        'can_send_contact' => $user->anonymous_can_send_contact,
        'can_send_note' => $user->anonymous_can_send_note,
        'can_send_task' => $user->anonymous_can_send_task,
    ];
}

unset($_SESSION['account/connections/default/messages']);

include_once '../../../../fns/Form/label.php';
$items = [Form\label('Username', 'Any other username')];

include_once '../../../../fns/Form/checkbox.php';

$name = 'can_send_bookmark';
$title = 'Can send bookmarks';
$checked = $values['can_send_bookmark'];
$items[] = Form\checkbox($base, $name, $title, $checked);

$name = 'can_send_channel';
$title = 'Can send channels';
$checked = $values['can_send_channel'];
$items[] = Form\checkbox($base, $name, $title, $checked);

$name = 'can_send_contact';
$title = 'Can send contacts';
$checked = $values['can_send_contact'];
$items[] = Form\checkbox($base, $name, $title, $checked);

$name = 'can_send_note';
$title = 'Can send notes';
$checked = $values['can_send_note'];
$items[] = Form\checkbox($base, $name, $title, $checked);

$name = 'can_send_task';
$title = 'Can send tasks';
$checked = $values['can_send_task'];
$items[] = Form\checkbox($base, $name, $title, $checked);

include_once '../../../../fns/Form/button.php';
$items[] = Form\button('Save Changes');

include_once '../../../../fns/create_tabs.php';
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
        .join('<div class="hr"></div>', $items)
    .'</form>'
);

include_once '../../../../fns/echo_page.php';
echo_page($user, 'Edit Default Connection', $content, $base);
