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
        [
            'title' => 'General Information',
            'href' => '../general-info/',
        ],
        [
            'title' => 'MySQL Settings',
            'href' => '../mysql-settings/',
        ],
    ], 'Administrator', ['Finalize Installation']);
}
