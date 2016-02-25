<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/contact_method_page.php';
contact_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the contact to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the contact.',
        ],
        'full_name' => [
            'type' => 'string',
            'description' => 'The full name of the contact.',
        ],
        'alias' => [
            'type' => 'string',
            'description' => 'The alias of the contact.',
        ],
        'address' => [
            'type' => 'string',
            'description' => 'The address of the contact.',
        ],
        'email1' => [
            'type' => 'string',
            'description' => 'The primary email of the contact.',
        ],
        'email1_label' => [
            'type' => 'string',
            'description' => 'The label of the primary email of the contact.',
        ],
        'email2' => [
            'type' => 'string',
            'description' => 'The secondary email of the contact.',
        ],
        'email2_label' => [
            'type' => 'string',
            'description' => 'The label of the secondary email of the contact.',
        ],
        'phone1' => [
            'type' => 'string',
            'description' => 'The primary phone of the contact.',
        ],
        'phone1_label' => [
            'type' => 'string',
            'description' => 'The label of the primary phone of the contact.',
        ],
        'phone2' => [
            'type' => 'string',
            'description' => 'The secondary phone of the contact.',
        ],
        'phone2_label' => [
            'type' => 'string',
            'description' => 'The label of the secondary phone of the contact.',
        ],
        'birthday_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of the birthday of the contact.',
        ],
        'username' => [
            'type' => 'string',
            'description' => 'The Zvini username of the contact.',
        ],
        'timezone' => [
            'type' => 'number',
            'description' => 'The timezone offset of the contact in minutes.',
        ],
        'tags' => [
            'type' => 'string',
            'description' => 'The space-separated list of tags.',
        ],
        'notes' => [
            'type' => 'string',
            'description' => 'Additional notes of the contact.',
        ],
        'favorite' => [
            'type' => 'boolean',
            'description' => 'Whether the contact is marked as favorite.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the contact was created.',
        ],
        'update_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the contact was last modified.',
        ],
    ],
], [
    'CONTACT_NOT_FOUND' => "A contact with the ID doesn't exist.",
]);
