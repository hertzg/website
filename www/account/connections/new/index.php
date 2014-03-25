<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['account/connections/index_errors'],
    $_SESSION['account/connections/index_messages']
);

if (array_key_exists('account/connections/new/index_values', $_SESSION)) {
    $values = $_SESSION['account/connections/new/index_values'];
} else {
    $values = array(
        'username' => '',
        'can_subscribe_to_my_channel' => false,
    );
}

include_once '../../../fns/Form/textfield.php';
$items = array(
    Form\textfield('username', 'Username', array(
        'value' => $values['username'],
    )),
);

include_once '../../../fns/Form/checkbox.php';
$name = 'can_subscribe_to_my_channel';
$title = 'Can subscribe to my channel';
$checked = $values['can_subscribe_to_my_channel'];
$items[] = Form\checkbox($base, $name, $title, $checked);

include_once '../../../fns/Form/button.php';
$items[] = Form\button('Save Connection');

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ),
        array(
            'title' => 'Connections',
            'href' => '..',
        ),
    ),
    'New',
    Page\sessionErrors('account/connections/new/index_errors')
    .'<form action="submit.php" method="post">'
        .join('<div class="hr"></div>', $items)
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Connection', $content, $base);
