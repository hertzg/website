<?php

function create_connections_link ($user) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Manage Connections';
    $href = 'connections/';
    $icon = 'connections';
    $options = ['id' => 'connections'];

    $num_connections = $user->num_connections;
    if ($num_connections) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            "$num_connections total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
