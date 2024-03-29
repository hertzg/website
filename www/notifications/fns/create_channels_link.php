<?php

function create_channels_link ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    $title = 'My Channels';
    $icon = 'channels';
    $href = "{$base}channels/";
    $num_channels = $user->num_channels;
    $options = ['id' => 'channels'];
    if ($num_channels) {
        $description = "$num_channels total.";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon, $options);
    }
    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
