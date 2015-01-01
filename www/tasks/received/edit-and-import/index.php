<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once '../fns/require_received_task.php';
include_once '../../../lib/mysqli.php';
list($receivedTask, $id, $user) = require_received_task($mysqli, '../');

unset($_SESSION['tasks/received/view/messages']);

$key = 'tasks/received/edit-and-import/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    $deadline_time = $receivedTask->deadline_time;
    if ($deadline_time === null) {
        $deadline_day = $deadline_month = $deadline_year = 0;
    } else {
        $deadline_day = date('d', $deadline_time);
        $deadline_month = date('n', $deadline_time);
        $deadline_year = date('Y', $deadline_time);
    }

    $values = [
        'text' => $receivedTask->text,
        'deadline_day' => $deadline_day,
        'deadline_month' => $deadline_month,
        'deadline_year' => $deadline_year,
        'tags' => $receivedTask->tags,
        'top_priority' => $receivedTask->top_priority,
    ];

}

include_once "$fnsDir/Tasks/maxLengths.php";
$maxLengths = Tasks\maxLengths();

include_once '../../fns/create_form_items.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/hidden.php";
include_once "$fnsDir/ItemList/Received/escapedItemQuery.php";
include_once "$fnsDir/ItemList/Received/itemHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => "Received Task #$id",
                'href' => '../view/'.ItemList\Received\escapedItemQuery($id).'#edit-and-import',
            ],
        ],
        'Edit and Import',
        Page\sessionErrors('tasks/received/edit-and-import/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Import Task')
            .ItemList\Received\itemHiddenInputs($id)
        .'</form>'
    )
    .compressed_js_script('flexTextarea', $base)
    .compressed_js_script('formCheckbox', $base);

include_once "$fnsDir/echo_page.php";
$title = "Edit and Import Received Task #$id";
echo_page($user, $title, $content, $base);
