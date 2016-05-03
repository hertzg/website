<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/invitation_method_page.php';
invitation_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the invitations.',
            ],
            'key' => [
                'type' => 'string',
                'description' => 'The key of the invitation to sign up with.',
            ],
            'note' => [
                'type' => 'string',
                'description' => 'The note of the invitation.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the invitation was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' => 'The Unix timestamp of'
                    .' when the invitation was last modified.',
            ],
        ],
    ],
], []);
