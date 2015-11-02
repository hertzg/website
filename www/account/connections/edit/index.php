<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

unset($_SESSION['account/connections/view/messages']);

$base = '../../../';
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
        'can_send_channel' => $connection->can_send_channel,
        'can_send_contact' => $connection->can_send_contact,
        'can_send_file' => $connection->can_send_file,
        'can_send_note' => $connection->can_send_note,
        'can_send_place' => $connection->can_send_place,
        'can_send_task' => $connection->can_send_task,
    ];
}

include_once '../fns/create_form_items.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => "Connection #$id",
                'href' => "../view/?id=$id#edit",
            ],
        ],
        'Edit',
        Page\sessionErrors('account/connections/edit/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Save Changes')
            .Form\hidden('id', $id)
        .'</form>'
    )
    .compressed_js_script('formCheckbox', $base);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Connection #$id", $content, $base);
