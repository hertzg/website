<?php

function create_connections_link ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Manage Connections';
    $href = 'connections/';
    $icon = 'connections';
    $options = ['id' => 'connections'];

    include_once "$fnsDir/AdminConnections/count.php";
    $num_admin_connections = AdminConnections\count($mysqli);

    if ($num_admin_connections) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            "$num_admin_connections total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
