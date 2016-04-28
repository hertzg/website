<?php

function create_steps () {
    include_once __DIR__.'/../../fns/steps.php';
    return steps([
        [
            'title' => 'Agreement',
            'href' => '../agreement/',
        ],
        [
            'title' => 'Requirements',
            'href' => '../requirements/',
        ],
    ], 'General Information', [
        'MySQL Settings',
        'Administrator',
        'Finalize Installation',
    ]);

}
