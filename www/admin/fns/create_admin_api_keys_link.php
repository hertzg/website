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
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            "$num_api_keys total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
