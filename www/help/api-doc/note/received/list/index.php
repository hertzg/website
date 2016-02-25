<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_note_method_page.php';
received_note_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the received notes.',
            ],
            'sender_username' => [
                'type' => 'string',
                'description' => 'The username of who sent the note.',
            ],
            'text' => [
                'type' => 'string',
                'description' => 'The text of the received note.',
            ],
            'encrypt_in_listings' => [
                'type' => 'boolean',
                'description' =>
                    'Whether the received note is encrypted in listings.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'The space-separated list of tags.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the note was received.',
            ],
        ],
    ],
], []);
