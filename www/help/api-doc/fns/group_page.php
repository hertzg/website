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
            $name, $description, "$name/", 'api-method', ['id' => $name]);
    }

    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/text.php";
    $content = Page\create(
        [
            'title' => 'API Documentation',
            'href' => "../#$groupKey",
        ],
        $group['title'],
        Page\text("$group[description]:")
        .join('<div class="hr"></div>', $items)
    );

    if ($subgroups !== null) {

        $items = [];
        foreach ($subgroups as $key => $subgroup) {
            $items[] = Page\imageArrowLinkWithDescription(
                $subgroup['title'], "$subgroup[description].",
                "$key/", 'api-namespace', ['id' => $key]);
        }
        $items = join('<div class="hr"></div>', $items);

        include_once "$fnsDir/Page/panel.php";
        $content .= \Page\panel('Subnamespaces', $items);

    }

    include_once "$fnsDir/echo_public_page.php";
    echo_public_page($user, "$groupKey Namespace", $content, '../../../');

}
