<?php

function create_channels_link ($user, $href) {
    $title = 'Channels';
    $icon = 'channels';
    $num_channels = $user->num_channels;
    if ($num_channels) {
        $description = "$num_channels total.";
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon);
}
