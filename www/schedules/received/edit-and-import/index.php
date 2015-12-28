<?php

$fnsDir = '../../../fns';

include_once '../fns/require_received_schedule.php';
include_once '../../../lib/mysqli.php';
list($receivedSchedule, $id, $user) = require_received_schedule($mysqli, '../');

unset($_SESSION['schedules/received/view/messages']);

$key = 'schedules/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'text',
        'text' => $receivedSchedule->text,
        'interval' => $receivedSchedule->interval,
        'tags' => $receivedSchedule->tags,
    ];
}

include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
$escapedItemQuery = ItemList\Received\escapedItemQuery($id);

include_once '../../fns/create_first_stage_form_items.php';
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Received Schedule #$id",
        'href' => "../view/$escapedItemQuery#edit-and-import",
    ],
    'Edit and Import',
    Page\sessionErrors('schedules/received/edit-and-import/errors')
    .'<form action="submit.php" method="post">'
        .create_first_stage_form_items($values)
        .ItemList\Received\itemHiddenInputs($id)
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit and Import Received Schedule #$id",
    $content, '../../../');
