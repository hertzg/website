<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/invitation_method_page.php';
invitation_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the invitation to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the invitation.',
        ],
        'key' => [
            'type' => 'string',
            'description' => 'The key of the invitation to create an account.',
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
], [
    'INVITATION_NOT_FOUND' => "An invitation with the ID doesn't exist.",
]);
