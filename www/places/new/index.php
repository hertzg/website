<?php

$base = '../../';
$fnsDir = '../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'places/new/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {

    include_once "$fnsDir/Places/request.php";
    list($latitude, $longitude, $altitude, $name,
        $description, $tags, $parsed_latitude, $parsed_longitude,
        $parsed_altitude) = Places\request();

    $values = [
        'latitude' => $latitude,
        'longitude' => $longitude,
        'altitude' => $altitude,
        'name' => $name,
        'description' => $description,
        'tags' => $tags,
    ];
}

unset(
    $_SESSION['home/messages'],
    $_SESSION['places/errors'],
    $_SESSION['places/messages']
);

include_once '../fns/create_form_items.php';
include_once '../fns/create_geolocation_panel.php';
include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
include_once "$fnsDir/Page/tabs.php";
$content =
    Page\tabs(
        [
            [
                'title' => 'Places',
                'href' => ItemList\listHref(),
            ],
        ],
        'New Place',
        Page\sessionErrors('places/new/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Page\staticTwoColumns(
                Form\button('Save'),
                Form\button('Send', 'sendButton')
            )
            .ItemList\pageHiddenInputs()
        .'</form>'
    )
    .create_geolocation_panel($base);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Place', $content, $base);
