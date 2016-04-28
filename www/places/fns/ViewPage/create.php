<?php

namespace ViewPage;

function create ($mysqli, $place, &$scripts, &$head) {

    $id = $place->id;
    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/Form/label.php";
    $items = [
        \Form\label('Latitude', $place->latitude),
        \Form\label('Longitude', $place->longitude),
    ];

    $altitude = $place->altitude;
    if ($altitude !== null) $items[] = \Form\label('Altitude', $altitude);

    $name = $place->name;
    if ($name !== '') {

        include_once "$fnsDir/request_strings.php";
        list($keyword) = request_strings('keyword');

        include_once "$fnsDir/parse_keyword.php";
        parse_keyword($keyword, $includes, $excludes);

        $name = htmlspecialchars($name);
        if ($includes) {
            include_once "$fnsDir/keyword_regex.php";
            $regex = keyword_regex($includes);
            $name = preg_replace($regex, '<mark>$0</mark>', $name);
        }

        $items[] = \Form\label('Name', $name);

    }

    $description = $place->description;
    if ($description !== '') {
        $description = nl2br(htmlspecialchars($description));
        $items[] = \Form\label('Description', $description);
    }

    if ($place->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags('', json_decode($place->tags_json));
    }

    include_once "$fnsDir/format_author.php";
    $author = format_author($place->insert_time, $place->insert_api_key_name);
    $infoText = "Place created $author.";
    if ($place->revision) {
        $author = format_author($place->update_time,
            $place->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/nearPlaces.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once __DIR__.'/pointsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Places',
                'href' => \ItemList\listHref()."#$id",
            ],
            "Place #$id",
            \Page\sessionMessages('places/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Place', '../')
        )
        .nearPlaces($mysqli, $place)
        .pointsPanel($mysqli, $place)
        .optionsPanel($place);

}
