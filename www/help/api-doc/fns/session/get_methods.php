<?php

namespace session;

function get_methods () {
    return [
        'authenticate' => 'Authenticate the current session.',
        'extend' => 'Extend the lifetime of the current session.',
        'invalidate' => 'Invalidate the current session.',
    ];
}
