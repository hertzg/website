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
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            "$num_invitations total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
