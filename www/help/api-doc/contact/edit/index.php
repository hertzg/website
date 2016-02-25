<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/contact_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
contact_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to edit.',
    ],
    [
        'name' => 'full_name',
        'description' => 'The new full name of the contact.',
    ],
    [
        'name' => 'alias',
        'description' => 'The new alias of the contact.',
    ],
    [
        'name' => 'address',
        'description' => 'The new address of the contact.',
    ],
    [
        'name' => 'email1',
        'description' => 'The new primary email of the contact.',
    ],
    [
        'name' => 'email1_label',
        'description' => 'The new label of the primary email of the contact.',
    ],
    [
        'name' => 'email2',
        'description' => 'The new secondary email of the contact.',
    ],
    [
        'name' => 'email2_label',
        'description' => 'The new label of the secondary email of the contact.',
    ],
    [
        'name' => 'phone1',
        'description' => 'The new primary phone number of the contact.',
    ],
    [
        'name' => 'phone1_label',
        'description' =>
            'The new label of the primary phone number of the contact.',
    ],
    [
        'name' => 'phone2',
        'description' => 'The new secondary phone number of the contact.',
    ],
    [
        'name' => 'phone2_label',
        'description' =>
            'The new label of the secondary phone number of the contact.',
    ],
    [
        'name' => 'birthday_time',
        'description' => 'The new Unix timestamp'
            .' of the birthday of the contact.',
    ],
    [
        'name' => 'username',
        'description' => 'The new Zvini username of the contact.',
    ],
    [
        'name' => 'timezone',
        'description' => 'The new timezone offset of the contact in minutes.',
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
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
    'ENTER_FULL_NAME' => 'The new full name is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
]);
