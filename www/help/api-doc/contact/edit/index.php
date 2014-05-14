<?php

include_once '../fns/contact_method_page.php';
contact_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to edit.',
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
        'name' => 'phone1',
        'description' => 'The primary phone number of the contact.',
    ],
    [
        'name' => 'phone2',
        'description' => 'The secondary phone number of the contact.',
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
        'name' => 'tags',
        'description' => 'Space-separated list of tags.',
    ],
    [
        'name' => 'favorite',
        'description' => 'Whether the contact should be marked as favorite.',
    ],
], ['CONTACT_NOT_FOUND', 'ENTER_FULL_NAME', 'TOO_MANY_TAGS']);
