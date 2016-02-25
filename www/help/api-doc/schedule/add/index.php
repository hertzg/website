<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/schedule_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
schedule_method_page('add', [
    [
        'name' => 'text',
        'description' => 'The text of the schedule.',
    ],
    [
        'name' => 'interval',
        'description' => 'The number of days in which the schedule repeats.'
            .' Its value can be 2 or greater.',
    ],
    [
        'name' => 'offset',
        'description' => 'The number of days from January 1st 1970'
            .' to the next day on which the schedule is effective.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created schedule.',
], [
    'ENTER_TEXT' => 'The text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
