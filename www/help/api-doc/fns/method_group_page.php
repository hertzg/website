<?php

function method_group_page (array $keys, array $methods) {

    $base = '../../../';

    include_once __DIR__.'/method_groups.php';
    $method_groups = method_groups();

    $method_group = $method_groups[array_shift($keys)];
    foreach ($keys as $key) $method_group = $method_group['subgroups'][$key];

    $title = $method_group['title'];

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user($base);

    include_once __DIR__.'/../../../fns/Page/imageArrowLinkWithDescription.php';
    $items = [];
    foreach ($methods as $name => $description) {
        $items[] = Page\imageArrowLinkWithDescription(
            $name, $description, "$name/", 'generic');
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
        $title,
        join('<div class="hr"></div>', $items)
    );

    include_once __DIR__.'/../../../fns/echo_page.php';
    echo_page($user, $title, $content, $base);

}
