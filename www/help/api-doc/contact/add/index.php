<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/contact_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
contact_method_page('add', [
    [
        'name' => 'full_name',
        'description' => 'The full name of the contact.',
    ],
    [
        'name' => 'alias',
        'description' => 'The alias of the contact.',
    ],
    [
        'name' => 'address',
        'description' => 'The address of the contact.',
    ],
    [
        'name' => 'email1',
        'description' => 'The primary email of the contact.',
    ],
    [
        'name' => 'email1_label',
        'description' => 'The label of the primary email of the contact.',
    ],
    [
        'name' => 'email2',
        'description' => 'The secondary email of the contact.',
    ],
    [
        'name' => 'email2_label',
        'description' => 'The label of the secondary email of the contact.',
    ],
    [
        'name' => 'phone1',
        'description' => 'The primary phone number of the contact.',
    ],
    [
        'name' => 'phone1_label',
        'description' =>
            'The label of the primary phone number of the contact.',
    ],
    [
        'name' => 'phone2',
        'description' => 'The secondary phone number of the contact.',
    ],
    [
        'name' => 'phone2_label',
        'description' =>
            'The label of the secondary phone number of the contact.',
    ],
    [
        'name' => 'birthday_time',
        'description' => 'The Unix timestamp of the birthday of the contact.',
    ],
    [
        'name' => 'username',
        'description' => 'The Zvini username of the contact.',
    ],
    [
        'name' => 'timezone',
        'description' => 'The timezone offset of the contact in minutes.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
    [
        'name' => 'notes',
        'description' => 'Additional notes of the contact.',
    ],
    [
        'name' => 'favorite',
        'description' => 'Whether the contact should be marked as favorite.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created contact.',
], [
    'ENTER_FULL_NAME' => 'The full name is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
