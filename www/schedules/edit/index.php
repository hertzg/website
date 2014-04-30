<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

$key = 'schedules/edit/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'text' => $schedule->text,
        'day_interval' => $schedule->day_interval,
        'day_offset' => '',
    ];
}

unset($_SESSION['schedules/view/messages']);

include_once '../fns/create_interval_select.php';
include_once '../fns/create_offset_select.php';
include_once '../../fns/create_panel.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '..',
        ],
        [
            'title' => "Schedule #$id",
            'href' => "../view/?id=$id",
        ],
    ],
    'Edit',
    Page\sessionErrors('schedules/edit/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('text', 'Text', [
            'value' => $values['text'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .create_interval_select($values['day_interval'])
        .'<div class="hr"></div>'
        .create_offset_select($values['day_offset'])
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
        .Form\hidden('id', $id)
    .'</form>'
);

include_once '../../fns/echo_page.php';
echo_page($user, "Schedule #$id", $content, '../../');
