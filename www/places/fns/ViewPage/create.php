<?php

namespace ViewPage;

function create ($mysqli, $place, &$scripts, &$head) {

    $id = $place->id;
    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('newItemMenu', $base);

    include_once "$fnsDir/Form/label.php";
    $items = [
        \Form\label('Latitude', $place->latitude),
        \Form\label('Longitude', $place->longitude),
    ];

    $altitude = $place->altitude;
    if ($altitude !== null) $items[] = \Form\label('Altitude', $altitude);

    $name = $place->name;
    if ($name !== '') {
        $items[] = \Form\label('Name', htmlspecialchars($name));
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

    unset(
        $_SESSION['places/new-point/errors'],
        $_SESSION['places/new-point/values'],
        $_SESSION['places/edit/errors'],
        $_SESSION['places/edit/values'],
        $_SESSION['places/errors'],
        $_SESSION['places/messages'],
        $_SESSION['places/send/errors'],
        $_SESSION['places/send/messages'],
        $_SESSION['places/send/values'],
        $_SESSION['places/view-point/messages']
    );

    include_once __DIR__.'/nearPlaces.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once __DIR__.'/pointsPanel.php';
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemMenu.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Places',
                    'href' => \ItemList\listHref()."#$id",
                ],
            ],
            "Place #$id",
            \Page\sessionMessages('places/view/messages')
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText)
            .nearPlaces($mysqli, $place),
            \Page\newItemMenu(
                \Page\imageArrowLink('Place',
                    '../new/'.\ItemList\escapedPageQuery(), 'create-place')
                .'<div class="hr"></div>'
                .\Page\imageArrowLink('Point',
                    '../new-point/'.\ItemList\escapedItemQuery($id),
                    'create-point')
            )
        )
        .pointsPanel($mysqli, $place)
        .optionsPanel($place);

}
