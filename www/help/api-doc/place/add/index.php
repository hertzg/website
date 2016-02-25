<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/place_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
place_method_page('add', [
    [
        'name' => 'latitude',
        'description' => 'The latitude of the place.',
    ],
    [
        'name' => 'longitude',
        'description' => 'The longitude of the place.',
    ],
    [
        'name' => 'altitude',
        'description' => 'The altitude of the place.',
    ],
    [
        'name' => 'name',
        'description' => 'The name of the place.',
    ],
    [
        'name' => 'description',
        'description' => 'The description of the place.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created place.',
], [
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
