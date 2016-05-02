<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

unset($_SESSION['account/connections/view/messages']);

$fnsDir = '../../../fns';

$key = 'account/connections/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    include_once "$fnsDir/restore_expires.php";
    $values = [
        'username' => $connection->username,
        'address' => $connection->address,
        'expires' => restore_expires($connection->expire_time),
        'can_send_bookmark' => $connection->can_send_bookmark,
        'can_send_calculation' => $connection->can_send_calculation,
        'can_send_channel' => $connection->can_send_channel,
        'can_send_contact' => $connection->can_send_contact,
        'can_send_file' => $connection->can_send_file,
        'can_send_note' => $connection->can_send_note,
        'can_send_place' => $connection->can_send_place,
        'can_send_schedule' => $connection->can_send_schedule,
        'can_send_task' => $connection->can_send_task,
    ];
}

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Connection #$id",
        'href' => "../view/?id=$id#edit",
    ],
    'Edit',
    Page\sessionErrors('account/connections/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values, $scripts)
        .Form\button('Save Changes')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Connection #$id",
    $content, '../../../', ['scripts' => $scripts]);
