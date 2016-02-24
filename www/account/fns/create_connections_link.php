<?php

function create_connections_link ($user) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Manage Connections';
    $href = 'connections/';
    $icon = 'connections';
    $options = ['id' => 'connections'];

    $num_connections = $user->num_connections;
    if ($num_connections) {
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return Page\thumbnailLinkWithDescription($title,
            "$num_connections total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return Page\thumbnailLink($title, $href, $icon, $options);

}
