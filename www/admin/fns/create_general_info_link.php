<?php

function create_general_info_link () {

    $fnsDir = __DIR__.'/../../fns';

    $title = 'General Information';
    $href = 'general-info/';
    $icon = 'generic';
    $options = ['id' => 'general-info'];

    include_once "$fnsDir/get_client_address.php";
    $client_address = get_client_address();

    if ($client_address === false) {
        $description =
            '<span class="colorText red">'
                .'With this settings a client IP address cannot be detected.'
            .'</span>';
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}
