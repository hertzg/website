<?php

function subgroup_page ($groupKey, $subgroup, $subgroupKey, $methods) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/get_groups.php';
    $groups = get_groups();

    $title = $subgroup['title'];

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $items = [];
    foreach ($methods as $name => $description) {
        $items[] = Page\imageArrowLinkWithDescription($name,
            $description, "$name/", 'api-method', ['id' => $name]);
    }

    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/text.php";
    $content = Page\create(
        [
            'title' => $groups[$groupKey]['title'],
            'href' => "../#$subgroupKey",
        ],
        $title,
        Page\text("$subgroup[description]:")
        .join('<div class="hr"></div>', $items)
    );

    include_once "$fnsDir/echo_public_page.php";
    echo_public_page($user, "$groupKey/$subgroupKey Namespace",
        $content, '../../../../');

}
