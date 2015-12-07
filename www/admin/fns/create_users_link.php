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
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return Page\thumbnailLinkWithDescription($title,
            "$num_users total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return Page\thumbnailLink($title, $href, $icon, $options);

}
