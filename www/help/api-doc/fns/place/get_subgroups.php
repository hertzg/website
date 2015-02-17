<?php

namespace place;

function get_subgroups () {
    return [
        'point' => [
            'title' => 'Point',
            'description' => 'Methods for manipulating place points',
        ],
        'received' => [
            'title' => 'Received',
            'description' => 'Methods for manipulating received places',
        ],
    ];
}
