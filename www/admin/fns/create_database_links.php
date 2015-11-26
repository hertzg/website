<?php

function create_database_links ($mysqli) {

    if ($mysqli->connect_errno) return;

    include_once __DIR__.'/create_admin_api_keys_link.php';
    include_once __DIR__.'/create_connections_link.php';
    include_once __DIR__.'/create_invitations_link.php';
    include_once __DIR__.'/create_users_link.php';
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    return
        '<div class="hr"></div>'
        .create_admin_api_keys_link($mysqli)
        .'<div class="hr"></div>'
        .create_connections_link($mysqli)
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Invalid Signins', 'invalid-signins/',
            'invalid-sign-ins', ['id' => 'invalid-signins'])
        .'<div class="hr"></div>'
        .create_invitations_link($mysqli)
        .'<div class="hr"></div>'
        .create_users_link($mysqli);

}
