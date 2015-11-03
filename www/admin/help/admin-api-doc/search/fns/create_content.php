<?php

function create_content ($items) {
    include_once __DIR__.'/../../../../../fns/Page/tabs.php';
    return Page\tabs(
        [
            [
                'title' => 'Help',
                'href' => '../../#admin-api-doc',
            ],
        ],
        'Admin API Documentation',
        join('<div class="hr"></div>', $items)
    );
}
