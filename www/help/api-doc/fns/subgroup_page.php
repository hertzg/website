<?php

function subgroup_page ($groupKey, $subgroup, $subgroupKey, array $methods) {

    include_once __DIR__.'/get_groups.php';
    $groups = get_groups();

    $title = $subgroup['title'];

    include_once __DIR__.'/../../../fns/signed_user.php';
    $user = signed_user();

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
                'title' => $groups[$groupKey]['title'],
                'href' => '..',
            ],
        ],
        $title,
        Page\warnings(["$subgroup[description]:"])
        .join('<div class="hr"></div>', $items)
    );

    include_once __DIR__.'/../../../fns/echo_page.php';
    echo_page($user, "$groupKey/$subgroupKey Namespace", $content, '../../../../');

}
