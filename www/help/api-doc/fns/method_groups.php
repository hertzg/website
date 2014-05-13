<?php

function method_groups () {
    return [
        'bookmark' => [
            'title' => 'Bookmark',
            'description' => 'Methods for manipulating bookmarks.',
            'subgroups' => [
                'received' => [
                    'title' => 'Received',
                    'description' => 'Methods for manipulating received bookmarks.',
                ],
            ],
        ],
        'channel' => [
            'title' => 'Channel',
            'description' => 'Methods for manipulating channels.',
        ],
        'contact' => [
            'title' => 'Contact',
            'description' => 'Methods for manipulating contacts.',
            'subgroups' => [
                'received' => [
                    'title' => 'Received',
                    'description' => 'Methods for manipulating received contacts.',
                ],
            ],
        ],
        'note' => [
            'title' => 'Note',
            'description' => 'Methods for manipulating notes.',
            'subgroups' => [
                'received' => [
                    'title' => 'Received',
                    'description' => 'Methods for manipulating received notes.',
                ],
            ],
        ],
        'notification' => [
            'title' => 'Notification',
            'description' => 'Methods for sending and receiving notifications.',
        ],
        'task' => [
            'title' => 'Task',
            'description' => 'Methods for manipulating tasks.',
            'subgroups' => [
                'received' => [
                    'title' => 'Received',
                    'description' => 'Methods for manipulating received tasks.',
                ],
            ],
        ],
    ];
}
