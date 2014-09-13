<?php

function group_page ($groupKey, $methods, $subgroups = null) {

    include_once __DIR__.'/get_groups.php';
    $groups = get_groups();

    $group = $groups[$groupKey];

    $fnsDir = __DIR__.'/../../../fns';

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
                'title' => 'API Documentation',
                'href' => '..',
            ],
        ],
        $group['title'],
        Page\warnings(["$group[description]:"])
        .join('<div class="hr"></div>', $items)
    );

    if ($subgroups) {

        $items = [];
        foreach ($subgroups as $key => $subgroup) {
            $items[] = Page\imageArrowLinkWithDescription($subgroup['title'],
                "$subgroup[description].", "$key/", 'generic');
        }
        $items = join('<div class="hr"></div>', $items);

        include_once "$fnsDir/create_panel.php";
        $content .= create_panel('Subnamespaces', $items);

    }

    include_once "$fnsDir/echo_page.php";
    echo_page($user, "$groupKey Namespace", $content, '../../../');

}
