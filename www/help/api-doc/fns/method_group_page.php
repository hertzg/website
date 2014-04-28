<?php

function method_group_page ($groupName, $prefix, array $methods) {

    $base = '../../../';

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user($base);

    include_once __DIR__.'/../../../fns/Page/imageLinkWithDescription.php';
    $items = [];
    foreach ($methods as $name => $description) {
        $items[] = Page\imageLinkWithDescription($name,
            $description, "$name/", 'TODO');
    }

    include_once __DIR__.'/../../../fns/Page/tabs.php';
    $content = Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'API Documentation',
                'href' => '..',
            ],
        ],
        $groupName,
        join('<div class="hr"></div>', $items)
    );

    include_once __DIR__.'/../../../fns/echo_page.php';
    echo_page($user, $groupName, $content, $base);

}
