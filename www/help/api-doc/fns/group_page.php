<?php

function group_page ($groupKey, array $methods, array $subgroups = null) {

    $base = '../../../';

    include_once __DIR__.'/get_groups.php';
    $groups = get_groups();

    $group = $groups[$groupKey];

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user($base);

    include_once __DIR__.'/../../../fns/Page/imageArrowLinkWithDescription.php';
    $items = [];
    foreach ($methods as $name => $description) {
        $items[] = Page\imageArrowLinkWithDescription(
            $name, $description, "$name/", 'generic');
    }

    include_once __DIR__.'/../../../fns/Page/tabs.php';
    include_once __DIR__.'/../../../fns/Page/warnings.php';
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
        $group['title'],
        Page\warnings([$group['description']])
        .join('<div class="hr"></div>', $items)
    );

    if ($subgroups) {
        $items = [];
        foreach ($subgroups as $key => $subgroup) {
            $items[] = Page\imageArrowLinkWithDescription($subgroup['title'],
                $subgroup['description'], "$key/", 'generic');
        }
        include_once __DIR__.'/../../../fns/create_panel.php';
        $content .= create_panel('Subnamespaces', join('<div class="hr"></div>', $items));
    }

    include_once __DIR__.'/../../../fns/echo_page.php';
    echo_page($user, "$groupKey Namespace", $content, $base);

}
