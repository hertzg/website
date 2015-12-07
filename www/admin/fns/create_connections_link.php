<?php

function create_connections_link ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Connections';
    $href = 'connections/';
    $icon = 'connections';
    $options = ['id' => 'connections'];

    include_once "$fnsDir/AdminConnections/count.php";
    $num_admin_connections = AdminConnections\count($mysqli);

    if ($num_admin_connections) {
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return Page\thumbnailLinkWithDescription($title,
            "$num_admin_connections total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return Page\thumbnailLink($title, $href, $icon, $options);

}
