<?php

namespace contact;

function get_subgroups () {
    return [
        'photo' => [
            'title' => 'Photo',
            'description' => 'Methods for manipulating photos of contacts',
        ],
        'received' => [
            'title' => 'Received',
            'description' => 'Methods for manipulating received contacts',
        ],
    ];
}
