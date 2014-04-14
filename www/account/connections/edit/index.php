<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

$base = '../../../';

$key = 'account/connections/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = (array)$connection;

include_once '../../../fns/Form/textfield.php';
$items = [
    Form\textfield('username', 'Username', [
        'value' => $values['username'],
        'required' => true,
        'autofocus' => true,
    ]),
];

include_once '../../../fns/Form/checkbox.php';

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

$name = 'can_send_file';
$title = 'Can send files';
$checked = $values['can_send_file'];
$items[] = Form\checkbox($base, $name, $title, $checked);

$name = 'can_send_note';
$title = 'Can send notes';
$checked = $values['can_send_note'];
$items[] = Form\checkbox($base, $name, $title, $checked);

$name = 'can_send_task';
$title = 'Can send tasks';
$checked = $values['can_send_task'];
$items[] = Form\checkbox($base, $name, $title, $checked);

include_once '../../../fns/Form/button.php';
$items[] = Form\button('Save Changes');

unset($_SESSION['account/connections/view/messages']);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/hidden.php';
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
        .join('<div class="hr"></div>', $items)
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Edit Connection #$id", $content, $base);
