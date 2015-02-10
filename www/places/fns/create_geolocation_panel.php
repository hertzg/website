<?php

function create_geolocation_panel ($base) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    $content = Page\imageArrowLinkWithDescription('Use Geolocation',
        'Use GPS to detect the current location.', '../geolocation', 'gps',
        ['id' => 'geolocationLink']);

    include_once "$fnsDir/create_panel.php";
    return
        create_panel('Options', $content)
        .compressed_js_script('geolocationDialog', $base);

}
