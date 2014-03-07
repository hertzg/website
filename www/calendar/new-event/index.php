<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../lib/page.php';

include_once '../../fns/request_strings.php';
list($year, $month, $day) = request_strings('year', 'month', 'day');

if (array_key_exists('calendar/add-event_lastpost', $_SESSION)) {
    $values = $_SESSION['calendar/add-event_lastpost'];
} else {
    $values = array('eventtext' => '');
}

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('calendar/add-event_errors');

$year = (int)$year;
$month = (int)$month;
$day = (int)$day;
$time = mktime(0, 0, 0, $month, $day, $year);

unset($_SESSION['calendar/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/hidden.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Form/textfield.php';

$page->base = '../../';
$page->title = 'New Event';
$page->finish(
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
        $pageErrors
        .'<form action="submit.php" method="post">'
            .Form\label('When', date('F d, Y', $time))
            .'<div class="hr"></div>'
            .Form\textfield('eventtext', 'Text', array(
                'value' => $values['eventtext'],
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Save')
            .Form\hidden('year', $year)
            .Form\hidden('month', $month)
            .Form\hidden('day', $day)
        .'</form>'
    )
);
