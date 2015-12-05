<?php

function create_database_links ($mysqli) {

    if ($mysqli->connect_errno) return;

    include_once __DIR__.'/create_admin_api_keys_link.php';
    include_once __DIR__.'/create_connections_link.php';
    include_once __DIR__.'/create_invitations_link.php';
    include_once __DIR__.'/create_users_link.php';
    include_once __DIR__.'/../../fns/Page/thumbnailLink.php';
    include_once __DIR__.'/../../fns/Page/thumbnails.php';
    return Page\thumbnails([
        create_admin_api_keys_link($mysqli),
        create_connections_link($mysqli),
        Page\thumbnailLink('Invalid Signins', 'invalid-signins/',
            'invalid-sign-ins', ['id' => 'invalid-signins']),
        create_invitations_link($mysqli),
        create_users_link($mysqli),
    ])
    .'<div class="hr"></div>';

}
