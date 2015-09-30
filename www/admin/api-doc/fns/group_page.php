<?php

function group_page ($groupKey, $methods) {

    include_once __DIR__.'/get_groups.php';
    $groups = get_groups();

    $group = $groups[$groupKey];

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $items = [];
    foreach ($methods as $name => $description) {
        $items[] = Page\imageArrowLinkWithDescription(
            $name, $description, "$name/", 'api-method', ['id' => $name]);
    }

    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/text.php";
    $content = Page\tabs(
        [
            [
                'title' => 'Admin API Documentation',
                'href' => "../#$groupKey",
            ],
        ],
        $group['title'],
        Page\text("$group[description]:")
        .join('<div class="hr"></div>', $items)
    );

    include_once __DIR__.'/../../fns/echo_admin_page.php';
    echo_admin_page("$groupKey Namespace", $content, '../../');

}
