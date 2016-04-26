<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_user_with_password.php';
$user = require_user_with_password('../../');

$fnsDir = '../../../fns';

unset(
    $_SESSION['account/connections/errors'],
    $_SESSION['account/connections/messages'],
    $_SESSION['account/connections/view/messages']
);

$key = 'account/connections/new/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'username' => '',
        'address' => null,
        'expires' => 'never',
        'can_send_bookmark' => false,
        'can_send_calculation' => false,
        'can_send_channel' => false,
        'can_send_contact' => false,
        'can_send_file' => false,
        'can_send_note' => false,
        'can_send_place' => false,
        'can_send_schedule' => false,
        'can_send_task' => false,
    ];
}

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Connections',
        'href' => '..',
    ],
    'New Connection',
    Page\sessionErrors('account/connections/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values, $scripts)
        .'<div class="hr"></div>'
        .Form\button('Save Connection')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Connection',
    $content, '../../../', ['scripts' => $scripts]);
