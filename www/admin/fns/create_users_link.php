<?php

function create_users_link ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Users';
    $href = 'users/';
    $icon = 'users';
    $options = ['id' => 'users'];

    include_once "$fnsDir/Users/count.php";
    $num_users = Users\count($mysqli);

    if ($num_users) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            "$num_users total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
