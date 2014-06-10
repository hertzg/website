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

include_once '../fns/days_left_from_today.php';
$days_left = days_left_from_today($schedule->interval, $schedule->offset);

include_once '../fns/format_days_left.php';
$next = format_days_left($days_left);

include_once '../../fns/create_panel.php';
include_once '../../fns/Form/label.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/staticTwoColumns.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
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
    .Form\label('Repeats in every', "$schedule->interval days")
    .'<div class="hr"></div>'
    .Form\label('Next', $next)
    .create_panel(
        'Schedule Options',
        Page\staticTwoColumns(
            Page\imageArrowLink('Edit', "../edit/?id=$id", 'edit-schedule'),
            Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        )
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, "Schedule #$id", $content, '../../');
