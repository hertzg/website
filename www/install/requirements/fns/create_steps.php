<?php

function create_steps () {
    include_once __DIR__.'/../../fns/steps.php';
    return steps([
        [
            'title' => 'Agreement',
            'href' => '../agreement/',
        ],
    ], 'Requirements', [
        'General Information',
        'MySQL Settings',
        'Administrator',
        'Finalize Installation',
    ]);
}
