<?php

function create_subscribed_channels_link ($user, $base = '') {

    $fnsPageDir = __DIR__.'/../../fns/Page';

    $title = 'Other Channels';
    $icon = 'subscribed-channels';
    $href = "{$base}subscribed-channels/";
    $num_subscribed_channels = $user->num_subscribed_channels;
    if ($num_subscribed_channels) {
        $description = "$num_subscribed_channels total.";
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }
    include_once "$fnsPageDir/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon);

}
