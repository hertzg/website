<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset(
    $_SESSION['schedules/edit/next/first_stage'],
    $_SESSION['schedules/view/messages']
);

$key = 'schedules/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'focus' => 'text',
        'text' => $schedule->text,
        'interval' => $schedule->interval,
        'tags' => $schedule->tags,
    ];
}

include_once '../fns/create_first_stage_form_items.php';
include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/create.php';
include_once '../../fns/Page/sessionErrors.php';
$content = Page\create(
    [
        'title' => "Schedule #$id",
        'href' => '../view/'.ItemList\escapedItemQuery($id).'#edit',
    ],
    'Edit',
    Page\sessionErrors('schedules/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_first_stage_form_items($values)
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_user_page.php';
echo_user_page($user, "Edit Schedule #$id", $content, '../../');
