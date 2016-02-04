<?php

function create_content ($items) {
    include_once __DIR__.'/../../../../fns/Page/create.php';
    return Page\create(
        [
            'title' => 'Help',
            'href' => '../../#api-doc',
            'localNavigation' => true,
        ],
        'API Documentation',
        join('<div class="hr"></div>', $items)
    );
}
