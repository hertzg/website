<?php

namespace ViewPointPage;

function create ($point, &$scripts) {

    $id = $point->id;
    $id_places = $point->id_places;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $editLink = \Page\imageLink('Edit',
        "../edit-point/$escapedItemQuery", 'edit-place');

    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete',
                "../delete-point/$escapedItemQuery", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = \Page\staticTwoColumns($editLink, $deleteLink);

    unset(
        $_SESSION['places/edit-point/errors'],
        $_SESSION['places/edit-point/values'],
        $_SESSION['places/new-point/errors'],
        $_SESSION['places/new-point/values'],
        $_SESSION['places/view/messages']
    );

    include_once __DIR__.'/viewContent.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return \Page\create(
        [
            'title' => "Place #$id_places",
            'href' => '../view/'.\ItemList\escapedItemQuery($id_places),
        ],
        "Point #$id",
        \Page\sessionMessages('places/view-point/messages')
        .viewContent($point, $scripts)
        .create_panel('Point Options', $optionsContent),
        \Page\newItemButton("../new-point/?id=$id_places", 'Point')
    );

}
