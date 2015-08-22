<?php

include_once '../fns/received_contact_method_page.php';
received_contact_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the received contacts.',
            ],
            'sender_username' => [
                'type' => 'string',
                'description' =>
                    'The username of who the contact was received from.',
            ],
            'full_name' => [
                'type' => 'string',
                'description' => 'The full name of the received contact.',
            ],
            'alias' => [
                'type' => 'string',
                'description' => 'The alias of the received contact.',
            ],
            'address' => [
                'type' => 'string',
                'description' => 'The address of the received contact.',
            ],
            'email' => [
                'type' => 'string',
                'description' => 'The email of the received contact.',
            ],
            'phone1' => [
                'type' => 'string',
                'description' => 'The primary phone of the received contact.',
            ],
            'phone2' => [
                'type' => 'string',
                'description' => 'The secondary phone of the received contact.',
            ],
            'birthday_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of the birthday of the received contact.',
            ],
            'username' => [
                'type' => 'string',
                'description' => 'The Zvini username of the received contact.',
            ],
            'timezone' => [
                'type' => 'number',
                'description' =>
                    'The timezone offset of the received contact in minutes.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'A space-separated list of tags.',
            ],
            'notes' => [
                'type' => 'string',
                'description' => 'Additional notes of the received contact.',
            ],
            'favorite' => [
                'type' => 'boolean',
                'description' =>
                    'Whether the received contact is marked as favorite.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the contact was received.',
            ],
        ],
    ],
], []);
