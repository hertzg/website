<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/contact_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
contact_method_page('send', [
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
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
], ApiDoc\trueResult(), [
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive contacts from you.",
    'ENTER_FULL_NAME' => 'The full name is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
