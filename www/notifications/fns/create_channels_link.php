<?php

function create_channels_link ($user, $href) {
    $title = 'Channels';
    $icon = 'channels';
    $num_channels = $user->num_channels;
    if ($num_channels) {
        $description = "$num_channels total.";
        return Page::imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }
    return Page::imageArrowLink($title, $href, $icon);
}
