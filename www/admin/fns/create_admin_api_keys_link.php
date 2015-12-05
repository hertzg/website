<?php

function create_admin_api_keys_link ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Admin API Keys';
    $href = 'api-keys/';
    $icon = 'api-keys';
    $options = ['id' => 'api-keys'];

    include_once "$fnsDir/AdminApiKeys/count.php";
    $num_api_keys = AdminApiKeys\count($mysqli);

    if ($num_api_keys) {
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return Page\thumbnailLinkWithDescription($title,
            "$num_api_keys total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return Page\thumbnailLink($title, $href, $icon, $options);

}
