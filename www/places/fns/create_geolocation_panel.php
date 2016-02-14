<?php

function create_geolocation_panel (&$scripts, $base,
    $latitude = null, $longitude = null, $altitude = null) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts .=
        '<script type="text/javascript">'
            .'var latitude = '.json_encode($latitude)."\n"
            .'var longitude = '.json_encode($longitude)."\n"
            .'var altitude = '.json_encode($altitude)."\n"
        .'</script>'
        .compressed_js_script('geolocationDialog', $base);

    include_once "$fnsDir/Page/imageLinkWithDescription.php";
    $content = Page\imageLinkWithDescription('Use Geolocation',
        'Use GPS to detect the current location.', '',
        'locate', ['id' => 'geolocationLink']);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', $content);

}
