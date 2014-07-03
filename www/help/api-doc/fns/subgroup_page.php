<?php

function subgroup_page ($groupKey, $subgroup, $subgroupKey, array $methods) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/get_groups.php';
    $groups = get_groups();

    $title = $subgroup['title'];

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $items = [];
    foreach ($methods as $name => $description) {
        $items[] = Page\imageArrowLinkWithDescription(
            $name, $description, "$name/", 'generic');
    }

    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/warnings.php";
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

    $title = "$groupKey/$subgroupKey Namespace";
    include_once "$fnsDir/echo_page.php";
    echo_page($user, $title, $content, '../../../../');

}
