<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/request_strings.php';
list($year, $month, $day) = request_strings('year', 'month', 'day');

if (array_key_exists('calendar/add-event/index_lastpost', $_SESSION)) {
    $values = $_SESSION['calendar/add-event/index_lastpost'];
} else {
    $values = array('eventtext' => '');
}

$year = (int)$year;
$month = (int)$month;
$day = (int)$day;
$time = mktime(0, 0, 0, $month, $day, $year);

unset(
    $_SESSION['calendar/index_errors'],
    $_SESSION['calendar/index_messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Form/textfield.php';
include_once '../../fns/Page/sessionErrors.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Calendar',
                'href' => '..',
            ),
        ),
        'New Event',
        Page\sessionErrors('calendar/add-event/index_errors')
        .'<form action="submit.php" method="post">'
            .Form\label('When', date('F d, Y', $time))
            .'<div class="hr"></div>'
            .Form\textfield('eventtext', 'Text', array(
                'value' => $values['eventtext'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Save Event')
            .Form\hidden('year', $year)
            .Form\hidden('month', $month)
            .Form\hidden('day', $day)
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'New Event', $content, $base);
