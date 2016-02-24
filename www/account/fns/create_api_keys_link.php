<?php

function create_api_keys_link ($user) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'API Keys';
    $href = 'api-keys/';
    $icon = 'api-keys';
    $options = ['id' => 'api-keys'];

    $num_api_keys = $user->num_api_keys;
    if ($num_api_keys) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            "$num_api_keys total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
