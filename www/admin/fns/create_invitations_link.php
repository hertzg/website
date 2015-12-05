<?php

function create_invitations_link ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Invitations';
    $href = 'invitations/';
    $icon = 'invitations';
    $options = ['id' => 'invitations'];

    include_once "$fnsDir/Invitations/count.php";
    $num_invitations = Invitations\count($mysqli);

    if ($num_invitations) {
        include_once "$fnsDir/Page/thumbnailLinkWithDescription.php";
        return Page\thumbnailLinkWithDescription($title,
            "$num_invitations total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/thumbnailLink.php";
    return Page\thumbnailLink($title, $href, $icon, $options);

}
