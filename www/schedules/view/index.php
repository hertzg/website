<?php

include_once '../fns/require_schedule.php';
include_once '../../lib/mysqli.php';
list($schedule, $id, $user) = require_schedule($mysqli);

unset(
    $_SESSION['schedules/edit/errors'],
    $_SESSION['schedules/edit/values'],
    $_SESSION['schedules/errors'],
    $_SESSION['schedules/messages']
);

include_once '../fns/day_offset_from_today.php';
$day_offset_from_today = day_offset_from_today($schedule->day_interval, $schedule->day_offset);

if ($day_offset_from_today == 0) {
    $next = 'Today';
} elseif ($day_offset_from_today == 1) {
    $next = 'Tomorrow';
} else {
    include_once '../../fns/time_today.php';
    $time = time_today() + $day_offset_from_today * 60 * 60 * 24;
    if ($day_offset_from_today < 7) {
        $next = date('l', $time);
    } else {
        $next = date('M j, l', $time);
    }
}

include_once '../../fns/create_panel.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ],
        [
            'title' => 'Schedules',
            'href' => '..',
        ],
    ],
    "Schedule #$id",
    Page\sessionMessages('schedules/view/messages')
    .Page\text(htmlspecialchars($schedule->text))
    .'<div class="hr"></div>'
    .Form\label('Next', $next)
    .create_panel(
        'Schedule Options',
        Page\twoColumns(
            Page\imageArrowLink('Edit', "../edit/?id=$id", 'TODO'),
            Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        )
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, "Schedule #$id", $content, '../../');
