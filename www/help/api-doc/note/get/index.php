<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/note_method_page.php';
note_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the note.',
        ],
        'text' => [
            'type' => 'string',
            'description' => 'The text of the note.',
        ],
        'encrypt_in_listings' => [
            'type' => 'boolean',
            'description' => 'Whether the note is encrypted in listings.',
        ],
        'password_protect' => [
            'type' => 'boolean',
            'description' => 'Whether the note is password-protected.',
        ],
        'tags' => [
            'type' => 'string',
            'description' => 'The space-separated list of tags.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the note was created.',
        ],
        'update_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the note was last modified.',
        ],
    ],
], [
    'NOTE_NOT_FOUND' => "A note with the ID doesn't exist.",
]);
