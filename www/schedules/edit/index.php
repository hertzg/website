<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

$key = 'schedules/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'text' => $schedule->text,
        'interval' => $schedule->interval,
    ];
}

unset(
    $_SESSION['schedules/edit/next/first_stage'],
    $_SESSION['schedules/view/messages']
);

include_once '../../fns/Schedules/maxLengths.php';
$maxLengths = Schedules\maxLengths();

include_once '../fns/create_interval_select.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/ItemList/escapedItemQuery.php';
include_once '../../fns/ItemList/itemHiddenInputs.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => "Schedule #$id",
            'href' => '../view/'.ItemList\escapedItemQuery($id),
        ],
    ],
    'Edit',
    Page\sessionErrors('schedules/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('text', 'Text', [
            'value' => $values['text'],
            'maxlength' => $maxLengths['text'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_interval_select($values['interval'])
        .'<div class="hr"></div>'
        .Form\button('Next')
        .ItemList\itemHiddenInputs($id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Edit Schedule #$id", $content, '../../');
