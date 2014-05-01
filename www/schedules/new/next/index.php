<?php

include_once 'fns/require_first_stage.php';
list($user, $first_stage) = require_first_stage();

$key = 'schedules/new/next/errors';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['day_offset' => 0];

include_once '../../fns/create_offset_select.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../../../home/',
        ],
        [
            'title' => 'Schedules',
            'href' => '../..',
        ],
    ],
    'New',
    Page\imageLink('Return back', '..', 'arrow-left')
    .'<div class="hr"></div>'
    .'<form action="submit.php" method="post">'
        .create_offset_select($first_stage['day_interval'], $values['day_offset'])
        .'<div class="hr"></div>'
        .Form\button('Save Schedule')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Schedule', $content, '../../../');
