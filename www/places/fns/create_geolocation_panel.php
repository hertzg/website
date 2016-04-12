<?php

function create_geolocation_panel (&$scripts, $base,
    $latitude = null, $longitude = null, $altitude = null) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .=
        '<script type="text/javascript">'
            .'var latitude = '.json_encode($latitude).','
                .'longitude = '.json_encode($longitude).','
                .'altitude = '.json_encode($altitude)
        .'</script>'
        .compressed_js_script('geolocationDialog', $base);

    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $content = Page\imageLinkWithDescription('Use Geolocation',
        'Use GPS to detect the current location.', '',
        'locate', ['id' => 'geolocationLink']);

    include_once "$fnsDir/Page/panel.php";
    return Page\panel('Options', $content);

}
