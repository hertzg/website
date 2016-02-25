<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/schedule_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
schedule_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the schedule to edit.',
    ],
    [
        'name' => 'text',
        'description' => 'The new text of the schedule.',
    ],
    [
        'name' => 'interval',
        'description' => 'The new number of days in which the schedule repeats.'
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
], ApiDoc\trueResult(), [
    'SCHEDULE_NOT_FOUND' => "A schedule with the ID doesn't exist.",
    'ENTER_TEXT' => 'The text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
