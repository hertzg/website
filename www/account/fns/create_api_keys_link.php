<?php

function create_api_keys_link ($user) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'API Keys';
    $href = 'api-keys/';
    $icon = 'api-keys';
    $options = ['id' => 'api-keys'];

    $num_api_keys = $user->num_api_keys;
    if ($num_api_keys) {
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return Page\thumbnailLinkWithDescription($title,
            "$num_api_keys total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return Page\thumbnailLink($title, $href, $icon, $options);

}
