<?php

include_once 'fns/require_first_stage.php';
list($user, $id, $schedule, $first_stage) = require_first_stage();

$day_interval = $schedule->day_interval;
include_once '../../../fns/time_today.php';
$dayNow = time_today() / (60 * 60 * 24);
$remainder = ($dayNow - $schedule->day_offset) % $day_interval;
if ($remainder) $day_offset = $day_interval - $remainder;
else $day_offset = 0;

include_once '../../fns/create_offset_select.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => "Schedule #$id",
            'href' => "../../view/?id=$id",
        ],
    ],
    'Edit',
    Page\imageLink('Back', "../?id=$id", 'arrow-left')
    .'<div class="hr"></div>'
    .'<form action="submit.php" method="post">'
        .create_offset_select($first_stage['day_interval'], $day_offset)
        .'<div class="hr"></div>'
        .Form\button('Save Changes')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Schedule', $content, '../../../');
