<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/place_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
place_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to edit.',
    ],
    [
        'name' => 'latitude',
        'description' => 'The new latitude of the place.',
    ],
    [
        'name' => 'longitude',
        'description' => 'The new longitude of the place.',
    ],
    [
        'name' => 'altitude',
        'description' => 'The new altitude of the place.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the place.',
    ],
    [
        'name' => 'description',
        'description' => 'The new description of the place.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], ApiDoc\trueResult(), [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
