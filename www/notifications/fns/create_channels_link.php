<?php

function create_channels_link ($user, $base = '') {

    $fnsPageDir = __DIR__.'/../../fns/Page';

    $title = 'My Channels';
    $icon = 'channels';
    $href = "{$base}channels/";
    $num_channels = $user->num_channels;
    if ($num_channels) {
        $description = "$num_channels total.";
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }
    include_once "$fnsPageDir/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon);

}
